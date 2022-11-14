<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'customers';
    protected $primaryKey = 'username';
    public $incrementing = false;
    public $timestamps = false;

    public function gender()
    {
        return $this->hasOne(Gender::class, 'id', 'gender');
    }

    public function favorites_stores()
    {
        return $this->belongsToMany(Store::class, 'favorite_stores', 'username_customer', 'username_store');
    }

    public function header_transactions()
    {
        return $this->hasMany(HeaderTransaction::class, 'username_customer', 'username');
    }

    public function carts()
    {
        return $this->belongsToMany(Good::class, 'carts', 'username_customer', 'kode_barang')->withPivot(['jumlah_barang', 'created_at', 'updated_at']);
    }

    public function reviews()
    {
        return $this->belongsToMany(Good::class, 'reviews', 'username', 'kode_barang')->withPivot(['rating', 'review', 'created_at', 'updated_at', 'deleted_at'])->whereNull('deleted_at')
            ->withTimestamps();
    }
}
