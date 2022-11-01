<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $genders = [
            [
                'id' => '0',
                'jenis' => 'Laki-laki',
            ],
            [
                'id' => '1',
                'jenis' => 'Perempuan',
            ]
        ];

        foreach ($genders as $key => $value) {
            DB::table('genders')->insert($value);
        }

        $users = [
            [
                'username' => 'halobangsatu',
                'name' => 'Halo Bang Satu',
                'password' => 'HaloBang123!',
                'address' => 'Jl Ngagel Jaya Tengah 1',
                'phone_number' => '081234567891',
                'gender' => false,
                'saldo' => 10000000,
            ],
            [
                'username' => 'halobangdua',
                'name' => 'Halo Bang Dua',
                'password' => 'HaloBang123!',
                'address' => 'Jl Ngagel Jaya Tengah 2',
                'phone_number' => '081234567892',
                'gender' => true,
                'saldo' => 20000000,
            ],
            [
                'username' => 'halobangtiga',
                'name' => 'Halo Bang Tiga',
                'password' => 'HaloBang123!',
                'address' => 'Jl Ngagel Jaya Tengah 3',
                'phone_number' => '081234567893',
                'gender' => false,
                'saldo' => 30000000,
            ],
            [
                'username' => 'halobangempat',
                'name' => 'Halo Bang Empat',
                'password' => 'HaloBang123!',
                'address' => 'Jl Ngagel Jaya Tengah 4',
                'phone_number' => '081234567894',
                'gender' => true,
                'saldo' => 40000000,
            ],
            [
                'username' => 'halobanglima',
                'name' => 'Halo Bang Lima',
                'password' => 'HaloBang123!',
                'address' => 'Jl Ngagel Jaya Tengah 5',
                'phone_number' => '081234567895',
                'gender' => false,
                'saldo' => 50000000,
            ],
        ];

        foreach ($users as $key => $value) {
            DB::table('customers')->insert($value);
        }

        $stores = [
            [
                'username' => 'tokobangsatu',
                'name' => 'Toko Bang Satu',
                'store_name' => 'Toko Satu',
                'password' => 'HaloBang123!',
                'bank_account' => '3871234561',
                'phone_number' => '08987654321',
                'gender' => false,
            ],
            [
                'username' => 'tokobangdua',
                'name' => 'Toko Bang Dua',
                'store_name' => 'Toko Dua',
                'password' => 'HaloBang123!',
                'bank_account' => '3871234562',
                'phone_number' => '08987654322',
                'gender' => true,
            ],
            [
                'username' => 'tokobangtiga',
                'name' => 'Toko Bang Tiga',
                'store_name' => 'Toko Tiga',
                'password' => 'HaloBang123!',
                'bank_account' => '3871234563',
                'phone_number' => '08987654323',
                'gender' => false,
            ],
            [
                'username' => 'tokobangempat',
                'name' => 'Toko Bang Empat',
                'store_name' => 'Toko Empat',
                'password' => 'HaloBang123!',
                'bank_account' => '3871234564',
                'phone_number' => '08987654324',
                'gender' => true,
            ],
            [
                'username' => 'tokobanglima',
                'name' => 'Toko Bang Lima',
                'store_name' => 'Toko Lima',
                'password' => 'HaloBang123!',
                'bank_account' => '3871234565',
                'phone_number' => '08987654325',
                'gender' => false,
            ],
        ];

        foreach ($stores as $key => $value) {
            DB::table('stores')->insert($value);
        }

        $goods = [
            [
                'kode_barang' => 'BA001',
                'nama_barang' => 'Baju',
                'harga_barang' => 10000,
                'stok_barang' => 10,
                'username_store' => 'tokobangsatu',
            ],
            [
                'kode_barang' => 'BA002',
                'nama_barang' => 'Babi',
                'harga_barang' => 20000,
                'stok_barang' => 20,
                'username_store' => 'tokobangsatu',
            ],
            [
                'kode_barang' => 'BA003',
                'nama_barang' => 'Batu',
                'harga_barang' => 30000,
                'stok_barang' => 30,
                'username_store' => 'tokobangsatu',
            ],
            [
                'kode_barang' => 'BA004',
                'nama_barang' => 'Batang',
                'harga_barang' => 40000,
                'stok_barang' => 40,
                'username_store' => 'tokobangsatu',
            ],
            [
                'kode_barang' => 'CE001',
                'nama_barang' => 'Celana',
                'harga_barang' => 25000,
                'stok_barang' => 50,
                'username_store' => 'tokobangdua',
            ]
        ];

        foreach ($goods as $key => $value) {
            DB::table('goods')->insert($value);
        }

        $carts = [
            [
                'username_customer' => 'halobangsatu',
                'username_store' => 'tokobangsatu',
                'kode_barang' => 'BA001',
                'jumlah_barang' => 1,
            ],
            [
                'username_customer' => 'halobangsatu',
                'username_store' => 'tokobangsatu',
                'kode_barang' => 'BA002',
                'jumlah_barang' => 2,
            ],
            [
                'username_customer' => 'halobangsatu',
                'username_store' => 'tokobangsatu',
                'kode_barang' => 'BA003',
                'jumlah_barang' => 3,
            ],
            [
                'username_customer' => 'halobangsatu',
                'username_store' => 'tokobangsatu',
                'kode_barang' => 'BA004',
                'jumlah_barang' => 4,
            ],
            [
                'username_customer' => 'halobangsatu',
                'username_store' => 'tokobangdua',
                'kode_barang' => 'CE001',
                'jumlah_barang' => 5,
            ],
        ];

        foreach ($carts as $key => $value) {
            DB::table('carts')->insert($value);
        }

        $fav_store = [
            [
                'username_customer' => 'halobangsatu',
                'username_store' => 'tokobangsatu',
            ],
            [
                'username_customer' => 'halobangsatu',
                'username_store' => 'tokobangdua',
            ],
            [
                'username_customer' => 'halobangsatu',
                'username_store' => 'tokobangtiga',
            ],
            [
                'username_customer' => 'halobangsatu',
                'username_store' => 'tokobangempat',
            ],
            [
                'username_customer' => 'halobangdua',
                'username_store' => 'tokobanglima',
            ],
        ];

        foreach ($fav_store as $key => $value) {
            DB::table('favorite_stores')->insert($value);
        }

        $posts = [
            [
                'username_store' => 'tokobangsatu',
                'content' => 'Ini adalah postingan pertama',
                'created_at' =>  \Carbon\Carbon::now(),
            ],
            [
                'username_store' => 'tokobangsatu',
                'content' => 'Ini adalah postingan kedua',
                'created_at' =>  \Carbon\Carbon::now(),
            ],
            [
                'username_store' => 'tokobangsatu',
                'content' => 'Ini adalah postingan ketiga',
                'created_at' =>  \Carbon\Carbon::now(),
            ],
            [
                'username_store' => 'tokobangdua',
                'content' => 'Ini adalah postingan pertama',
                'created_at' =>  \Carbon\Carbon::now(),
            ],
            [
                'username_store' => 'tokobangdua',
                'content' => 'Ini adalah postingan kedua',
                'created_at' =>  \Carbon\Carbon::now(),
            ],
        ];

        foreach ($posts as $key => $value) {
            DB::table('posts')->insert($value);
        }
    }
}
