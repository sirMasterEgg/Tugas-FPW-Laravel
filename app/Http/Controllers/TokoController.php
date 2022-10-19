<?php

namespace App\Http\Controllers;

use App\Rules\PasswordRule;
use App\Rules\StoreNameRule;
use App\Rules\UserExistRule;
use Illuminate\Http\Request;
use App\Rules\ConfirmPasswordRule;
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
        $rules = [
            'user_storename' => ['required', new StoreNameRule()],
            'user_ownername' => ['required'],
            'user_username' => ['required', 'string', 'min:8', 'alpha', new UserExistRule(Session::get('data'), $req->user_username, false)],
            'user_password' => ['required', new PasswordRule($req->user_username)],
            'user_confirm_password' => ['required', new PasswordRule($req->user_username), new ConfirmPasswordRule($req->user_password)],
            'user_bank' => ['required', 'numeric', 'digits_between:4,16'],
            'user_phone' => ['required', 'numeric', 'digits_between:8,14'],
            'user_gender' => ['required'],
            'user_termsncon' => ['required'],
        ];

        $messages = [
            'user_storename' => [
                'required' => 'Store name must be filled',
            ],
            'user_ownername' => [
                'required' => 'Fullname must be filled',
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
                'required' => 'Confirm Password must be filled',
            ],
            'user_bank' => [
                'required' => 'Bank account must be filled',
                'digits_between' => 'Bank account must be between 4 and 16 digits',
            ],
            'user_phone' => [
                'required' => 'Phone must be filled',
                'digits_between' => 'Phone must be between 8 and 14 digits',
            ],
            'user_gender' => [
                'required' => 'Gender must be selected'
            ],
            'user_termsncon' => [
                'required' => 'You must agree to the terms and conditions'
            ]
        ];

        $req->validate($rules, $messages);

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
        $rules = [
            'nama_barang' => ['required', 'string', 'min:8'],
            'harga_barang' => ['required', 'numeric', 'gt:0'],
        ];

        $messages = [
            'nama_barang' => [
                'required' => 'Item name must be filled',
                'min' => 'Item name must be more than 8 characters',
            ],
            'harga_barang' => [
                'required' => 'Item price must be filled',
                'gt' => 'Item price must be greater than 0',
            ],
        ];

        $req->validate($rules, $messages);

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
