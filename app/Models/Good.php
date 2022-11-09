<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    use HasFactory;

    protected $table = 'goods';
    protected $primaryKey = 'kode_barang';
    public $incrementing = false;
    public $timestamps = false;

    public function store()
    {
        return $this->belongsTo(Store::class, 'username', 'username_store');
    }

    public function header_transactions()
    {
        return $this->belongsToMany(HeaderTransaction::class, 'detail_trans', 'kode_barang', 'id_head_trans')->withPivot(['jumlah_barang', 'created_at', 'updated_at']);
    }

    public function carts()
    {
        return $this->belongsToMany(Customer::class, 'carts', 'kode_barang', 'username_customer')->withPivot(['jumlah_barang', 'created_at', 'updated_at']);
    }

    public function reviews()
    {
        return $this->belongsToMany(Customer::class, 'reviews', 'kode_barang', 'username')->withPivot(['rating', 'review', 'created_at', 'updated_at', 'deleted_at'])->whereNull('deleted_at')->withTimestamps();
    }
}
