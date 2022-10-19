<?php

namespace App\Http\Controllers;

use App\Rules\UserExistRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SiteController extends Controller
{
    public function login()
    {
        return view('login', ['title' => 'Login']);
    }

    public function doLogout()
    {
        Session::forget('active');
        return redirect()->route('login');
    }

    public function doLogin(Request $req)
    {
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

        $users = Session::get('data');

        if ($req->username_login == 'admin' && $req->password_login == 'admin') {
            return redirect()->route('admin-cust-list');
        }

        foreach ($users as $key => $value) {
            if (
                $value['user_username'] == $req->username_login &&
                $value['user_password'] == $req->password_login &&
                $value['user_role'] == 'customer'
            ) {
                Session::put('active', $value);
                return redirect()->route('customer-index');
            } else if (
                $value['user_username'] == $req->username_login &&
                $value['user_password'] == $req->password_login &&
                $value['user_role'] == 'store'
            ) {
                Session::put('active', $value);
                return redirect()->route('toko-index');
            }
        }
        return redirect()->back()->with('error', 'Username or password not match!');
    }
}
