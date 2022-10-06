<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function index()
    {
        // return view('customer.login');
        return view('customer.indexcustomer', ['title' => 'Home']);
    }

    public function register()
    {
        // return view('customer.login');
        return view('customer.registercustomer', ['title' => 'Register']);
    }

    public function doRegister(Request $req)
    {
        foreach ($req->except(['_token']) as $key => $value) {
            if ($value == null) {
                return redirect()->back()->with('error', 'Please fill all the fields!');
            }
        }

        if ($req->user_password != $req->user_confirm_password) {
            return redirect()->back()->with('error', 'Password not match!');
        }

        if (Session::get('data') != null) {
            foreach (Session::get('data') as $key => $value) {
                if ($value['user_username'] == $req->user_username && $value['user_role'] == 'customer') {
                    return redirect()->back()->with('error', 'Username already registered!');
                }
            }
        }

        $data = $req->except(['_token', 'user_confirm_password']);
        $data['user_role'] = 'customer';

        Session::push('data', $data);

        return redirect()->route('login')->with('success', 'Register customer success!');
    }

    public function getProfile()
    {
        // return view('customer.login');
        return view('customer.profilecustomer', ['title' => 'User Profile']);
    }

    public function doEditProfile(Request $req)
    {
        foreach ($req->except(['_token']) as $item) {
            if ($item == null) {
                return redirect()->back()->with('error', 'Please fill all the fields!');
            }
        }

        if ($req->user_new_password != $req->user_confirm_new_password) {
            return redirect()->back()->with('error', 'Password not match!');
        }

        if ($req->user_current_password != Session::get('active')['user_password']) {
            return redirect()->back()->with('error', 'Current password not match!');
        }

        $gender = Session::get('active')['user_gender'];
        $temp = [];
        $sessiontemp = Session::get('data');

        foreach ($sessiontemp as $item) {
            if ($item['user_username'] == Session::get('active')['user_username'] && $item['user_role'] == 'customer') {
                array_push($temp, [
                    'user_fullname' => $req->user_fullname,
                    'user_username' => $req->user_username,
                    'user_phone' => $req->user_phone,
                    'user_address' => $req->user_address,
                    'user_password' => $req->user_new_password,
                    'user_gender' => $gender,
                    'user_role' => 'customer'
                ]);
            } else {
                array_push($temp, $item);
            }
        }

        Session::forget('data');
        Session::put('data', $temp);

        foreach ($sessiontemp as $item) {
            if ($item['user_username'] == Session::get('active')['user_username'] && $item['user_role'] == Session::get('active')['user_role']) {
                $item['user_fullname'] = $req->user_fullname;
                $item['user_username'] = $req->user_username;
                $item['user_phone'] = $req->user_phone;
                $item['user_address'] = $req->user_address;
                $item['user_password'] = $req->user_new_password;

                Session::forget('active');
                Session::put('active', $item);
            }
        }

        return redirect()->back()->with('success', 'Edit profile success!');
    }

    public function getHistory()
    {
        // return view('customer.login');
        return view('customer.historycustomer', ['title' => 'History']);
    }
}
