<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderTransaction extends Model
{
    use HasFactory;
    protected $table = 'head_trans';

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'username', 'username_customer');
    }

    public function goods()
    {
        return $this->belongsToMany(Good::class, 'detail_trans', 'id_head_trans', 'kode_barang');
    }
}
