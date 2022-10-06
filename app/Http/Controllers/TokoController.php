<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TokoController extends Controller
{
    public function index()
    {
        // return view('toko.login');
        return view('toko.indextoko', ['title' => 'Seller Page']);
    }

    public function register()
    {
        // return view('toko.login');
        return view('toko.registertoko', ['title' => 'Register Seller']);
    }

    public function doRegister(Request $req)
    {
        if (!$req->has('user_termsncon')) {
            return redirect()->back()->with('error', 'Please check the terms and conditions!');
        }

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
                if ($value['user_username'] == $req->user_username && $value['user_role'] == 'store') {
                    return redirect()->back()->with('error', 'Username already registered!');
                }
            }
        }

        $data = $req->except(['_token', 'user_confirm_password']);
        $data['user_role'] = 'store';
        $data['items'] = [];


        Session::push('data', $data);

        return redirect()->route('login')->with('success', 'Register store success!');
    }

    public function getProfile()
    {
        // return view('toko.login');
        return view('toko.profiletoko', ['title' => 'Seller Profile']);
    }

    public function getItems()
    {
        return view('toko.itemstoko', ['title' => 'Seller Items']);
    }

    public function getAddItem()
    {
        return view('toko.additemtoko', ['title' => 'Add Item']);
    }

    public function doAddItem(Request $req)
    {
        foreach ($req->except(['_token']) as $key => $value) {
            if ($value == null) {
                return redirect()->back()->with('error', 'Please fill all the fields!');
            }
        }

        $data = Session::get('data');
        $indexActive = -1;

        $namaBarang = $req->nama_barang;
        $hargaBarang = $req->harga_barang;

        foreach ($data as $key => $value) {
            if ($value['user_username'] == Session::get('active')['user_username']) {
                $data[$key]['items'][] = [
                    'kode_barang' => $this->generateID($namaBarang),
                    'nama_barang' => $namaBarang,
                    'harga_barang' => $hargaBarang,
                    'jumlah_terjual' => 0
                ];
                $indexActive = $key;
            }
        }

        Session::put('data', $data);

        $activedata = Session::get('active');
        $activedata['items'] = $data[$indexActive]['items'];
        Session::put('active', $activedata);

        // dd(Session::get('data'));
        return redirect()->route('toko-items')->with('success', 'Add item success!');
    }

    private function generateID($nama)
    {
        $prefix = strtoupper(substr($nama, 0, 2));
        $counter = 1;
        foreach (Session::get('active')['items'] ?? [] as $key => $value) {
            if (substr($value['kode_barang'], 0, 2) == $prefix) {
                $counter++;
            }
        }
        return strtoupper($prefix) . str_pad($counter, 3, '0', STR_PAD_LEFT);
    }

    public function doDeleteItem($id = null)
    {
        $data = Session::get('data');
        $indexIDActive = -1;
        $indexItemSelected = -1;
        foreach ($data as $key => $value) {
            if ($value['user_username'] == Session::get('active')['user_username']) {
                foreach ($value['items'] as $key2 => $value2) {
                    if ($value2['kode_barang'] == $id) {
                        unset($data[$key]['items'][$key2]);
                        $indexIDActive = $key;
                        $indexItemSelected = $key2;
                    }
                }
            }
        }

        Session::put('data', $data);

        $activedata = Session::get('active');
        $activedata['items'] = $data[$indexIDActive]['items'];
        Session::put('active', $activedata);

        return redirect()->route('toko-items')->with('success', 'Delete item success!');
    }
}
