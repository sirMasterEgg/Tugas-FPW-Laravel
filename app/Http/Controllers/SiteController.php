<?php

namespace App\Http\Controllers;

use App\Rules\UserExistRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class SiteController extends Controller
{
    public function login()
    {
        // dump(Session::get('data'));
        if (Cookie::has('username')) {
            $users = Session::get('data') ?? [];
            $username = Cookie::get('username');
            $password = Cookie::get('password');
            $role = Cookie::get('role');

            if ($username == 'admin' && $password == 'admin') {
                return redirect()->route('admin-cust-list');
            }

            foreach ($users as $key => $value) {
                if (
                    $value['user_username'] == $username &&
                    $value['user_password'] == $password &&
                    $value['user_role'] == $role
                ) {
                    Session::put('active', $value);
                    return $role == 'customer' ? redirect()->route('customer-index') : redirect()->route('toko-index');
                }
            }
        }

        return view('login', ['title' => 'Login']);
    }

    public function doLogout()
    {
        Session::forget('active');
        Cookie::queue(Cookie::forget('username'));
        Cookie::queue(Cookie::forget('password'));
        Cookie::queue(Cookie::forget('role'));
        return redirect()->route('login');
    }

    public function doLogin(Request $req)
    {
        $users = Session::get('data');


        $rules = [
            'username_login' => ['required'],
            'password_login' => ['required'],
            'btnLogin' => [new UserExistRule(Session::get('data'), $req->username_login)]
        ];
        $messages = [
            'username_login.required' => 'Username must be filled',
            'password_login.required' => 'Password must be filled',
            'btnLogin' => 'User not found',
        ];

        $req->validate($rules, $messages);

        if ($req->username_login == 'admin' && $req->password_login == 'admin') {
            return redirect()->route('admin-cust-list');
        }

        foreach ($users as $key => $value) {
            if (
                $value['user_username'] == $req->username_login &&
                $value['user_password'] == $req->password_login &&
                $value['user_role'] == 'customer'
            ) {
                if ($req->remember_me) {
                    Cookie::queue('username', $req->username_login, 5);
                    Cookie::queue('password', $req->password_login, 5);
                    Cookie::queue('role', 'customer', 5);
                }
                Session::put('active', $value);
                return redirect()->route('customer-index');
            } else if (
                $value['user_username'] == $req->username_login &&
                $value['user_password'] == $req->password_login &&
                $value['user_role'] == 'store'
            ) {
                if ($req->remember_me) {
                    Cookie::queue('username', $req->username_login, 5);
                    Cookie::queue('password', $req->password_login, 5);
                    Cookie::queue('role', 'store', 5);
                }
                Session::put('active', $value);
                return redirect()->route('toko-index');
            }
        }
        return redirect()->back()->with('error', 'Username or password not match!');
    }
}
