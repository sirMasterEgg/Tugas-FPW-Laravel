<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'gender', 'id');
    }

    public function stores()
    {
        return $this->belongsTo(Strore::class, 'gender', 'id');
    }
}
