<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogPemenang extends Model
{
    use HasFactory;

    protected $fillable = ['nomor_undian'];
}
