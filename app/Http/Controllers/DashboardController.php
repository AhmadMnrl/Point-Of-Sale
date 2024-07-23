<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Request as UserRequest;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::all();
        $barang = Barang::all();
        $transaksi = Transaksi::all();
        $detail = TransaksiDetail::orderBy('created_at', 'desc')->get();
        
        $stok_kosong = Barang::where('stok', 0)->get();
    
        $hari_ini = Carbon::now()->format('Y-m-d');
        $transaksi_hari_ini = Transaksi::whereDate('tanggal', $hari_ini)->get();
    
        $transaksi_per_bulan = Transaksi::selectRaw('DATE_FORMAT(tanggal, "%Y-%m") as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->orderBy('bulan', 'asc')
            ->get();

        $pendingRequests = UserRequest::where('status', 'submitted')->count();
    
        return view('dashboard.index', compact('barang', 'transaksi', 'detail', 'transaksi_hari_ini', 'transaksi_per_bulan', 'stok_kosong','pendingRequests'));
    }    
}