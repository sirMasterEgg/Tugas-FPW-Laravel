<?php

namespace App\Http\Controllers;

use App\Models\Good;
use App\Models\Store;
use App\Models\Customer;
use App\Rules\PasswordRule;
use Termwind\Components\Dd;
use App\Rules\UserExistRule;
use Illuminate\Http\Request;
use App\Models\HeaderTransaction;
use App\Rules\PasswordBeforeRule;
use App\Rules\ConfirmPasswordRule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function index(Request $req)
    {
        $query = $req->query('query') ?? '';
        $query = strtolower($query);
        // $data = DB::table('stores')->select()->get();
        $data = Store::all();

        if ($query != '') {
            // $data = DB::table('stores')->select()->where(DB::raw('lower(name)'), 'like', "%$query%")->get();
            $data = Store::where(DB::raw('lower(name)'), 'like', "%$query%")->get();
        }

        // return view('customer.login');
        return view('customer.indexcustomer', ['title' => 'Home', 'data' => $data]);
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
            'user_username' => ['required', 'string', 'min:8', 'alpha'],
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

        /* $data = $req->except(['_token', 'user_confirm_password']);
        $data['saldo'] = 0;
        $data['user_role'] = 'customer';
        Session::push('data', $data); */

        $res = DB::table('customers')->insert([
            'username' => $req->user_username,
            'password' => $req->user_password,
            'name' => $req->user_fullname,
            'address' => $req->user_address,
            'phone_number' => $req->user_phone,
            'gender' => $req->user_gender,
        ]);

        if ($res) {
            return redirect()->route('login')->with('success', 'Register customer success!');
        } else {
            return redirect()->back()->with('error', 'Register failed');
        }
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

    public function getTopUp()
    {
        return view('customer.isisaldocustomer', ['title' => 'Top Up']);
    }

    public function doTopUp(Request $req)
    {
        //
        $rules = [
            'user_top_up' => ['required', 'numeric', 'min:0'],
            'user_current_password' => ['required'],
        ];
        $req->validate($rules);

        $data = Session::get('data');

        foreach ($data as $key => $item) {
            if ($item['user_username'] == Session::get('active')['user_username'] && $item['user_role'] == Session::get('active')['user_role'] && $item['user_password'] == $req->user_current_password) {
                $data[$key]['saldo'] += $req->user_top_up;
            }
        }

        Session::put('data', $data);
        $tempactive = Session::get('active');
        foreach ($data as $key => $value) {
            if ($value['user_username'] == $tempactive['user_username'] && $value['user_role'] == $tempactive['user_role']) {
                $tempactive['saldo'] = $value['saldo'];
            }
        }
        Session::put('active', $tempactive);
        return redirect()->back()->with('success', 'Top up success!');
    }

    public function getDetails($toko)
    {
        $res =  DB::table('goods as g')->select()->join('stores as s', 'g.username_store', '=', 's.username')->where('username_store', $toko)->get();
        /* $data = Session::get('data');
        $nama = '';
        foreach ($data as $key => $value) {
            if ($value['user_username'] == $toko) {
                $nama = $value;
            }
        } */
        $namaToko = DB::table('stores')->select('name')->where('username', $toko)->first();
        $posts = DB::table('posts')->select()->where('username_store', $toko)->get();
        return view('customer.detailcustomer', ['title' => 'Details', 'nama' => $res, 'namatoko' => $namaToko, 'posts' => $posts]);
    }

    public function getDetailsBarang($username_toko, $kode_barang)
    {
        $toko = Store::where('username', $username_toko)->first();
        $barang = Good::where('kode_barang', $kode_barang)->first();
        $terjual = $barang->header_transactions()->get();

        $reviews = $barang->reviews()->get();

        return view('customer.detailbarangcustomer', ['title' => 'Details Barang', 'toko' => $toko, 'barang' => $barang, 'terjual' => $terjual, 'reviews' => $reviews]);
    }

    public function addReview($username_toko, $kode_barang, Request $req)
    {
        // dump($username_toko);
        // dump($kode_barang);
        // dd($req->all());

        $rules = [
            'rating' => ['required', 'numeric', 'min:1', 'max:5'],
        ];
        $req->validate($rules);

        $barang = Good::where('kode_barang', $kode_barang)->first();
        $customer = Customer::where('username', Session::get('active'))->first();

        if ($barang->reviews->contains($customer)) {
            return redirect()->back()->with('error', 'You have already reviewed this product!');
        }

        $barang->reviews()->attach($customer, [
            'rating' => $req->rating,
            'review' => $req->review,
        ]);
        return redirect()->back()->with('success', 'Review added!');
    }

    public function addCart(Request $req)
    {
        /* $toko = json_decode($req->toko);
        $barang = json_decode($req->barang);

        $cart = Session::get('cart') ?? [];

        $user = Session::get('active');

        array_push($cart, [
            'cart_username' => $user['user_username'],
            'cart_toko' => $toko->user_storename,
            'cart_item' => [
                'item_code' => $barang->kode_barang,
                'item_name' => $barang->nama_barang,
                'item_quantity' => $req->jumlah,
                'item_price' => $barang->harga_barang,
            ]
        ]);

        Session::put('cart', $cart); */

        DB::table('carts')->insert([
            'username_customer' => Session::get('active'),
            'kode_barang' => $req->kode_barang,
            'jumlah_barang' => $req->jumlah,
        ]);

        return redirect()->back();
    }

    public function getCart()
    {
        $cart = DB::table('carts')->select(['*', DB::raw('jumlah_barang * harga_barang as subtotal')])->join('goods', 'carts.kode_barang', '=', 'goods.kode_barang')->where('username_customer', Session::get('active'))->get();
        return view('customer.cartcustomer', ['title' => 'Cart', 'cart' => $cart]);
    }

    public function removeCart(Request $req)
    {
        $cart = Session::get('cart');

        array_splice($cart, $req->index, 1);

        Session::put('cart', $cart);

        return redirect()->back();
    }

    public function checkoutCart(Request $req)
    {
        $saldo = DB::table('customers')->select('saldo')->where('username', Session::get('active'))->first();
        $kodebarang = DB::table('carts')->select(['kode_barang', 'jumlah_barang'])->where('username_customer', Session::get('active'))->get();

        if ($req->total > $saldo->saldo) {
            return redirect()->back()->with('error', 'Saldo tidak cukup!');
        }


        foreach ($kodebarang as $key => $value) {
            $barang = DB::table('goods')->select('stok_barang')->where('kode_barang', $value->kode_barang)->first();
            $stok = $barang->stok_barang;
            $jumlah = DB::table('carts')->select('jumlah_barang')->where('kode_barang', $value->kode_barang)->first();
            $jumlah = $jumlah->jumlah_barang;
            if ($stok < $jumlah) {
                return redirect()->back()->with('error', 'Stok barang tidak mencukupi!');
            }
        }

        foreach ($kodebarang as $key => $value) {
            $barang = DB::table('goods')->select('stok_barang')->where('kode_barang', $value->kode_barang)->first();
            $stok = $barang->stok_barang;
            $jumlah = DB::table('carts')->select('jumlah_barang')->where('kode_barang', $value->kode_barang)->first();
            $jumlah = $jumlah->jumlah_barang;
            $delta = $stok - $jumlah;

            DB::table('goods')->where('kode_barang', $value->kode_barang)->update(['stok_barang' => $delta]);
            DB::table('carts')->where('kode_barang', $value->kode_barang)->delete();
        }

        DB::table('customers')->where('username', Session::get('active'))->update(['saldo' => $saldo->saldo - $req->total]);


        /* $cart = Session::get('cart');

        $history = [];

        array_push($history, [
            'cart' => $cart,
            'total' => $req->total,
            'time' => date("Y-m-d")
        ]);

        Session::put('history', $history);
        Session::forget('cart'); */
        return redirect()->route('customer-history');
    }

    public function addFavorite($id)
    {
        $ada = DB::table('favorite_stores')->select()->where('username_customer', Session::get('active'))->where('username_store', $id)->first();
        if ($ada) {
            DB::table('favorite_stores')->where('username_customer', Session::get('active'))->where('username_store', $id)->delete();
        } else {
            DB::table('favorite_stores')->insert([
                'username_customer' => Session::get('active'),
                'username_store' => $id
            ]);
        }
        return redirect()->back();
    }

    public function getFavorite()
    {
        $data = DB::table('favorite_stores as fs')->select()
            ->join('stores as s', 'fs.username_store', '=', 's.username')
            ->where('username_customer', Session::get('active'))->get();
        return view('customer.favoritestore', ['title' => 'Favorite Store', 'data' => $data]);
    }
}
