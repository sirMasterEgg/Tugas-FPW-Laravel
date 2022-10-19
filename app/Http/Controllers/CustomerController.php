<?php

namespace App\Http\Controllers;

use App\Rules\ConfirmPasswordRule;
use App\Rules\PasswordBeforeRule;
use App\Rules\PasswordRule;
use App\Rules\UserExistRule;
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
        $rules = [
            'user_fullname' => ['required', 'string', 'max:50'],
            'user_username' => ['required', 'string', 'min:8', 'alpha', new UserExistRule(Session::get('data'), $req->user_username, false)],
            'user_password' => ['required', new PasswordRule($req->user_username)],
            'user_confirm_password' => ['required', new PasswordRule($req->user_username), new ConfirmPasswordRule($req->user_password)],
            'user_address' => ['required', 'string', 'min:12'],
            'user_phone' => ['required', 'numeric', 'digits_between:8,14'],
            'user_gender' => ['required'],
        ];

        $messages = [
            'user_fullname' => [
                'required' => 'Fullname must be filled',
                'max' => 'Fullname must be less than 50 characters',
            ],
            'user_username' => [
                'required' => 'Username must be filled',
                'min' => 'Username must be more than 8 characters',
                'alpha' => 'Username must not contain special characters, numbers, or spaces',
            ],
            'user_password' => [
                'required' => 'Password must be filled',
            ],
            'user_confirm_password' => [
                'required' => 'Password must be filled',
            ],
            'user_address' => [
                'required' => 'Address must be filled',
                'min' => 'Address must be more than 12 characters',
            ],
            'user_phone' => [
                'required' => 'Phone must be filled',
                'digits_between' => 'Phone must be between 8 and 14 digits',
            ],
            'user_gender' => [
                'required' => 'Gender must be selected'
            ]
        ];

        $req->validate($rules, $messages);

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
        $rules = [
            'user_fullname' => ['required', 'string', 'max:50'],
            'user_username' => ['required', 'string', 'min:8', 'alpha', new UserExistRule(Session::get('data'), $req->user_username, false)],
            'user_address' => ['required', 'string', 'min:12'],
            'user_phone' => ['required', 'numeric', 'digits_between:8,14'],
            'user_new_password' => [new PasswordBeforeRule(Session::get('active')['user_password']), new PasswordRule($req->user_username, true)],
            'user_new_confirm_password' => [new PasswordRule($req->user_username, true), new ConfirmPasswordRule($req->user_password)],
            'user_current_password' => ['required'],
        ];

        $messages = [
            'user_fullname' => [
                'required' => 'Fullname must be filled',
                'max' => 'Fullname must be less than 50 characters',
            ],
            'user_username' => [
                'required' => 'Username must be filled',
                'min' => 'Username must be more than 8 characters',
                'alpha' => 'Username must not contain special characters, numbers, or spaces',
            ],
            'user_password' => [
                'required' => 'Password must be filled',
            ],
            'user_confirm_password' => [
                'required' => 'Password must be filled',
            ],
            'user_address' => [
                'required' => 'Address must be filled',
                'min' => 'Address must be more than 12 characters',
            ],
            'user_phone' => [
                'required' => 'Phone must be filled',
                'digits_between' => 'Phone must be between 8 and 14 digits',
            ],
            'user_gender' => [
                'required' => 'Gender must be selected'
            ]
        ];

        $req->validate($rules, $messages);

        $gender = Session::get('active')['user_gender'] ?? 'Male';
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
