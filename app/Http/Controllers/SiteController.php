<?php

namespace App\Http\Controllers;


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
        foreach ($req->except(['_token']) as $key => $value) {
            if ($value == null) {
                return redirect()->back()->with('error', 'Please fill all the fields!');
            }
        }

        if ($req->username_login == 'admin' && $req->password_login == 'admin') {
            return redirect()->route('admin-cust-list');
        }

        if (Session::get('data') == null) {
            return redirect()->back()->with('error', 'User not found!');
        }

        foreach (Session::get('data') as $key => $value) {
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
