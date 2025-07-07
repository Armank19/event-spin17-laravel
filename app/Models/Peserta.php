<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;

    protected $table = 'peserta'; // pastikan nama tabel benar

    protected $fillable = [
        'nama',
        'id_karyawan',
        'email',
        'no_wa',
        'status_checkin',
        'nomor_undian',
    ];
}
