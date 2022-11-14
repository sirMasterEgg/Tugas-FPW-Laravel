<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    public $timestamps = false;

    // $table->string('log_username');
    // $table->string('log_statuscode');
    // $table->string('log_ip');
    // $table->string('log_path');
    // $table->dateTime('log_time');
    protected $fillable = [
        'log_username',
        'log_statuscode',
        'log_ip',
        'log_path',
        'log_time',
    ];
}
