<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Kategori;
use App\Models\Maintenance;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Dashboard statistics
        $totalAset = Aset::count();
        $totalKategori = Kategori::count();
        $totalMaintenance = Maintenance::count();

        // Asset status breakdown
        $asetTersedia = Aset::where('status', 'tersedia')->count();
        $asetMaintenance = Aset::where('status', 'maintenance')->count();
        $asetRusak = Aset::where('status', 'rusak')->count();
        $asetDipinjam = Aset::where('status', 'dipinjam')->count();

        // Recent assets
        $recentAsets = Aset::with('kategori')->orderBy('created_at', 'desc')->limit(5)->get();

        // Recent maintenance
        $recentMaintenance = Maintenance::with('aset')->orderBy('created_at', 'desc')->limit(5)->get();

        // Asset by category
        $asetByKategori = Kategori::withCount('asets')->get();

        // Total asset value
        $totalNilaiAset = Aset::sum('harga');

        return view('home', compact(
            'totalAset',
            'totalKategori',
            'totalMaintenance',
            'asetTersedia',
            'asetMaintenance',
            'asetRusak',
            'asetDipinjam',
            'recentAsets',
            'recentMaintenance',
            'asetByKategori',
            'totalNilaiAset'
        ));
    }
}
