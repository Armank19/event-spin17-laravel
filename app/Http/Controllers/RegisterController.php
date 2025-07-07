<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peserta;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class RegisterController extends Controller
{
    public function show()
    {
        return view('register');
    }

    public function submit(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255|unique:peserta,nama',
        'id_karyawan' => 'required|string|max:50|unique:peserta,id_karyawan',
        'email' => 'nullable|email',
        'no_wa' => 'nullable|string|max:20',
    ]);

    // Format nama dan ID
    $nama = strtoupper(trim($request->nama));
    $id_karyawan = trim($request->id_karyawan);

    // Buat nomor undian berformat 80th-00xx
    $count = Peserta::count() + 1;
    $nomor_undian = '80th-' . str_pad($count, 4, '0', STR_PAD_LEFT);

    // Simpan ke database
    $peserta = new Peserta();
    $peserta->nama = $nama;
    $peserta->id_karyawan = $id_karyawan;
    $peserta->email = $request->email;
    $peserta->no_wa = $request->no_wa;
    $peserta->nomor_undian = $nomor_undian;
    $peserta->save();

    // Tampilkan langsung halaman sukses dengan data
    return view('register-success', [
        'nama' => $nama,
        'id_karyawan' => $id_karyawan,
        'nomor_undian' => $nomor_undian
    ]);
}


    public function success(Request $request)
    {
        // Ambil dari session
        $nama = session('nama');
        $id_karyawan = session('id_karyawan');
        $nomor_undian = session('nomor_undian');

        if (!$nama || !$id_karyawan || !$nomor_undian) {
            return redirect()->route('register.show')->with('error', 'Akses tidak valid.');
        }

        return view('register-success')->with([
            'nama' => $nama,
            'id_karyawan' => $id_karyawan,
            'nomor_undian' => $nomor_undian,
        ]);
    }
}