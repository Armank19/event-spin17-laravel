<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peserta;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function statistik()
    {
        $totalPeserta = DB::table('peserta')->count();
        $totalCheckin = DB::table('peserta')->where('status_checkin', 'hadir')->count();
        $belumCheckin = $totalPeserta - $totalCheckin;
        $persentase = $totalPeserta > 0 ? round(($belumCheckin / $totalPeserta) * 100) : 0;

        return view('dashboard.statistik', compact('totalPeserta', 'totalCheckin', 'belumCheckin', 'persentase'));
    }

    public function index()
    {
        return view('dashboard.index');
    }

    public function spin()
    {
        return view('dashboard.spin');
    }

    public function participant()
    {
        $peserta = Peserta::all();
        return view('dashboard.participant', compact('peserta'));
    }
   
   
   
    public function deleteSelected(Request $request)
    {
    $ids = $request->input('ids');

    if ($ids && count($ids) > 0) {
        Peserta::whereIn('id', $ids)->delete();
        return redirect()->route('dashboard.participant')->with('success', 'Data berhasil dihapus.');
    }

    return redirect()->route('dashboard.participant')->with('error', 'Tidak ada data yang dipilih.');
    }

    

}