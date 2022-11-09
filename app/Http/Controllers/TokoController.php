<?php

namespace App\Http\Controllers;

use App\Models\Good;
use App\Models\Post;
use App\Models\Review;
use App\Rules\PasswordRule;
use Termwind\Components\Dd;
use App\Rules\StoreNameRule;
use App\Rules\UserExistRule;
use Illuminate\Http\Request;
use App\Rules\ConfirmPasswordRule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TokoController extends Controller
{
    public function index()
    {
        // return view('toko.login');
        $res = Good::where('username_store', Session::get('active'))->get();
        $posts = Post::where('username_store', Session::get('active'))->get();
        $reviews = Review::withTrashed()->join('customers as c', 'c.username', '=', 'reviews.username')->join('goods as g', 'g.kode_barang', '=', 'reviews.kode_barang')->get();
        // foreach ($res as $key => $value) {
        //     $reviews[] = $value;
        //     $reviews[$key]['reviews'] = $value->reviews;
        // }
        return view('toko.indextoko', ['title' => 'Seller Page', 'data' => $res, 'posts' => $posts, 'reviewsparent' => $reviews]);
    }

    public function register()
    {
        // return view('toko.login');
        return view('toko.registertoko', ['title' => 'Register Seller']);
    }

    public function doDeleteReview(Request $req)
    {
        $goods = Review::withTrashed()->where('kode_barang', $req->kode_barang)->where('username', $req->username_customer)->first();

        if ($goods->trashed()) {
            $res = $goods->restore();
        } else {
            $res = $goods->delete();
        }

        if ($res) {
            return redirect()->back()->with('success', 'Review berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Review gagal dihapus');
        }
    }

    public function doRegister(Request $req)
    {
        $rules = [
            'user_storename' => ['required', new StoreNameRule()],
            'user_ownername' => ['required'],
            'user_username' => ['required', 'string', 'min:8', 'alpha'],
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

        /* $data = $req->except(['_token', 'user_confirm_password']);
        $data['user_role'] = 'store';
        $data['items'] = [];


        Session::push('data', $data); */

        $res = DB::table('stores')->insert([
            'username' => $req->user_username,
            'password' => $req->user_password,
            'store_name' => $req->user_storename,
            'name' => $req->user_ownername,
            'bank_account' => $req->user_bank,
            'phone_number' => $req->user_phone,
            'gender' => $req->user_gender,
        ]);

        if ($res) {
            return redirect()->route('login')->with('success', 'Register store success!');
        } else {
            return redirect()->back()->with('error', 'Register store failed!');
        }
    }

    public function getProfile()
    {
        // return view('toko.login');
        return view('toko.profiletoko', ['title' => 'Seller Profile']);
    }

    public function getItems()
    {
        $res = DB::table('goods')->select()->where('username_store', Session::get('active'))->get();
        return view('toko.itemstoko', ['title' => 'Seller Items', 'data' => $res]);
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
            'stok_barang' => ['required', 'numeric', 'gt:0'],
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
            'stok_barang' => [
                'required' => 'Item stock must be filled',
                'gt' => 'Item stock must be greater than 0',
            ],
        ];

        $req->validate($rules, $messages);

        /* $data = Session::get('data');
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
        Session::put('active', $activedata); */

        // dd(Session::get('data'));

        $res = DB::table('goods')->insert([
            'kode_barang' => $this->generateID($req->nama_barang),
            'nama_barang' => $req->nama_barang,
            'harga_barang' => $req->harga_barang,
            'stok_barang' => $req->stok_barang,
            'username_store' => Session::get('active'),
        ]);
        if ($res) {
            return redirect()->route('toko-items')->with('success', 'Add item success!');
        } else {
            return redirect()->back()->with('error', 'Add item failed!');
        }
    }

    private function generateID($nama)
    {
        $prefix = strtoupper(substr($nama, 0, 2));
        $counter = 1;
        $res = DB::table('goods')->where('kode_barang', 'like', "$prefix%")->get()->count();
        $counter += $res;
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

    public function getPost()
    {
        $res = DB::table('posts')->select()->where('username_store', Session::get('active'))->get();
        return view('toko.post', ['title' => 'Post Item', 'data' => $res]);
    }

    public function doPost(Request $req)
    {
        $res = DB::table('posts')->insert([
            'username_store' => Session::get('active'),
            'content' => $req->message,
            'created_at' =>  \Carbon\Carbon::now(),
        ]);
        if ($res) {
            return redirect()->back()->with('success', 'Post success!');
        } else {
            return redirect()->back()->with('error', 'Post failed!');
        }
    }

    public function doHapusPost($id = null)
    {
        $res = DB::table('posts')->where('id', $id)->delete();
        if ($res) {
            return redirect()->back()->with('success', 'Delete post success!');
        } else {
            return redirect()->back()->with('error', 'Delete post failed!');
        }
    }
}
