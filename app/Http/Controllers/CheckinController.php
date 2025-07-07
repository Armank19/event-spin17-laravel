<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peserta;
use Carbon\Carbon;
class CheckinController extends Controller
{
    // Menampilkan halaman form check-in
    public function show()
    {
        return view('checkin');
    }

    // Proses check-in
    public function submit(Request $request)
{
    $request->validate([
        'id_karyawan' => 'required|string',
    ]);

    $peserta = Peserta::where('id_karyawan', $request->id_karyawan)->first();

    if (!$peserta) {
        return redirect()->route('checkin')->with('error', '❌ ID Karyawan tidak ditemukan.');
    }

    if ($peserta->status_checkin == 1) {
        return redirect()->route('checkin')->with('error', '⚠️ Peserta sudah melakukan check-in sebelumnya.');
    }

    // Update status dan waktu check-in
    $peserta->status_checkin = 1;
    $peserta->checkin_at = now();
    $peserta->save();

    return view('checkin-success', [
        'nama' => $peserta->nama,
        'id_karyawan' => $peserta->id_karyawan,
        'nomor_undian' => $peserta->nomor_undian,
        'checkin_at' => $peserta->checkin_at,
    ]);
}
}
