<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Kategori;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index()
    {
        // Statistik umum
        $totalAset = Aset::count();
        $totalKategori = Kategori::count();
        $totalMaintenance = Maintenance::count();
        $totalNilaiAset = Aset::sum('harga');

        // Statistik berdasarkan kondisi
        $kondisiBaik = Aset::where('kondisi', 'Baik')->count();
        $kondisiRusakRingan = Aset::where('kondisi', 'Rusak Ringan')->count();
        $kondisiRusakBerat = Aset::where('kondisi', 'Rusak Berat')->count();

        // Statistik berdasarkan status
        $statusTersedia = Aset::where('status', 'Tersedia')->count();
        $statusDipinjam = Aset::where('status', 'Dipinjam')->count();
        $statusMaintenance = Aset::where('status', 'Maintenance')->count();

        // Statistik berdasarkan kategori
        $asetPerKategori = Kategori::withCount('asets')->get();

        // Maintenance per bulan (6 bulan terakhir)
        $maintenancePerBulan = Maintenance::selectRaw('MONTH(tanggal_maintenance) as bulan, COUNT(*) as total')
            ->where('tanggal_maintenance', '>=', Carbon::now()->subMonths(6))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Aset terbaru
        $asetTerbaru = Aset::with('kategori')->latest()->take(5)->get();

        // Maintenance terbaru
        $maintenanceTerbaru = Maintenance::with('aset')->latest()->take(5)->get();

        return view('laporan.index', compact(
            'totalAset',
            'totalKategori',
            'totalMaintenance',
            'totalNilaiAset',
            'kondisiBaik',
            'kondisiRusakRingan',
            'kondisiRusakBerat',
            'statusTersedia',
            'statusDipinjam',
            'statusMaintenance',
            'asetPerKategori',
            'maintenancePerBulan',
            'asetTerbaru',
            'maintenanceTerbaru'
        ));
    }

    public function aset()
    {
        $asets = Aset::with(['kategori', 'maintenances'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('laporan.aset', compact('asets'));
    }

    public function maintenance()
    {
        $maintenances = Maintenance::with(['aset.kategori'])
            ->orderBy('tanggal_maintenance', 'desc')
            ->get();

        return view('laporan.maintenance', compact('maintenances'));
    }

    public function kategori()
    {
        $kategoris = Kategori::withCount('asets')->get();

        return view('laporan.kategori', compact('kategoris'));
    }

    public function exportAset(Request $request)
    {
        $query = Aset::with(['kategori']);

        // Filter berdasarkan kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        // Filter berdasarkan kondisi
        if ($request->filled('kondisi')) {
            $query->where('kondisi', $request->kondisi);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $asets = $query->get();

        // Generate PDF atau Excel
        if ($request->format === 'pdf') {
            return $this->exportAsetPDF($asets);
        } else {
            return $this->exportAsetExcel($asets);
        }
    }

    private function exportAsetPDF($asets)
    {
        // Implementasi export PDF
        return response()->json(['message' => 'Export PDF akan diimplementasikan']);
    }

    private function exportAsetExcel($asets)
    {
        // Implementasi export Excel
        return response()->json(['message' => 'Export Excel akan diimplementasikan']);
    }
}
