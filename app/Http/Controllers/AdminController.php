<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function getTokoList()
    {
        return view('admin.tokolist', ['title' => 'Admin Toko Page']);
    }

    public function getCustomerList()
    {
        return view('admin.customerlist', ['title' => 'Admin Customer Page']);
    }

    public function editCustomer($id = null)
    {
        foreach (Session::get('data') as $item) {
            if ($item['user_username'] == $id) {
                return view('admin.customerlistedit', ['title' => 'Edit Customer', 'data' => $item]);
            }
        }

        return view('admin.customerlistedit', ['title' => 'Admin Edit Customer Page']);
    }

    public function doEditCustomer(Request $req)
    {
        $data = Session::get('data');
        $indexSelected = -1;

        foreach ($req->except('_token') as $key => $value) {
            if ($value == null) {
                return redirect()->back()->with('error', 'Please fill all the fields!');
            }
        }

        foreach ($data as $key => $item) {
            if ($item['user_username'] == $req->id && $item['user_role'] == 'customer') {
                $indexSelected = $key;
            }
        }

        $data[$indexSelected]['user_fullname'] = $req->fullname;
        $data[$indexSelected]['user_username'] = $req->username;
        $data[$indexSelected]['user_phone'] = $req->phone;

        Session::put('data', $data);

        return redirect()->route('admin-cust-list')->with('success', 'Edit customer success!');
    }

    public function editToko($id = null)
    {
        foreach (Session::get('data') as $item) {
            if ($item['user_username'] == $id) {
                return view('admin.tokolistedit', ['title' => 'Edit Store', 'data' => $item]);
            }
        }

        return view('admin.customerlistedit', ['title' => 'Admin Edit Customer Page']);
    }

    public function doEditToko(Request $req)
    {
        $data = Session::get('data');
        $indexSelected = -1;

        foreach ($req->except('_token') as $key => $value) {
            if ($value == null) {
                return redirect()->back()->with('error', 'Please fill all the fields!');
            }
        }

        foreach ($data as $key => $item) {
            if ($item['user_username'] == $req->id && $item['user_role'] == 'store') {
                $indexSelected = $key;
            }
        }

        $data[$indexSelected]['user_storename'] = $req->storename;
        $data[$indexSelected]['user_username'] = $req->username;
        $data[$indexSelected]['user_phone'] = $req->phone;

        Session::put('data', $data);

        return redirect()->route('admin-toko-list')->with('success', 'Edit customer success!');
    }
}
