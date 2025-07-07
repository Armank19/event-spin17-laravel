<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemenang extends Model
{
    protected $table = 'pemenang';
    protected $fillable = ['nomor_undian'];
    public $timestamps = false;
}
