<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peserta;
use App\Models\LogPemenang;

class SpinController extends Controller
{
    
public function index()
{
    $winners = LogPemenang::orderBy('created_at', 'desc')->take(10)->get();
    $nomorUndians = Peserta::where('status_checkin', 1)->pluck('nomor_undian'); // Ambil semua nomor undian yang sudah check-in

    return view('dashboard.spin', compact('winners', 'nomorUndians'));
}


    public function performSpin()
    {
        $peserta = Peserta::where('status_checkin', 1)->inRandomOrder()->first();

        if (!$peserta) {
            return response()->json(['success' => false, 'message' => '❌ Tidak ada peserta check-in.']);
        }

        // Cek apakah sudah pernah menang jika ingin mencegah double
        LogPemenang::create([
            'nomor_undian' => $peserta->nomor_undian,
            'peserta_id' => $peserta->id,
        ]);

        return response()->json([
            'success' => true,
            'nomor_undian' => $peserta->nomor_undian,
        ]);
    }

    public function clearHistory()
    {
        LogPemenang::truncate();
        return redirect()->route('dashboard.spin')->with('success', 'Riwayat pemenang telah dihapus.');
    }
}
