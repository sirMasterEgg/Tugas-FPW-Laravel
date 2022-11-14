<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'stores';
    protected $primaryKey = 'username';
    public $incrementing = false;
    public $timestamps = false;

    public function gender()
    {
        return $this->hasOne(Gender::class, 'id', 'gender');
    }

    public function favorites_stores()
    {
        return $this->belongsToMany(Customer::class, 'favorite_stores', 'username_store', 'username_customer');
    }

    public function goods()
    {
        return $this->hasMany(Good::class, 'username_store', 'username');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'username_store', 'username');
    }
}
