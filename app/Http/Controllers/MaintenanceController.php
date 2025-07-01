<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maintenances = Maintenance::with(['aset', 'user'])->orderBy('created_at', 'desc')->get();
        return view('maintenance.index', compact('maintenances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $asets = Aset::where('status', '!=', 'hilang')->get();
        return view('maintenance.create', compact('asets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'aset_id' => 'required|exists:asets,id',
            'jenis_maintenance' => 'required|in:preventif,korektif,emergency',
            'tanggal_maintenance' => 'required|date',
            'deskripsi' => 'required|string',
            'biaya' => 'required|numeric|min:0',
            'teknisi' => 'required|string|max:255',
            'status' => 'required|in:pending,proses,selesai,dibatalkan',
            'catatan' => 'nullable|string'
        ]);

        $tanggalMaintenance = $request->tanggal_maintenance;
        if (strlen($tanggalMaintenance) === 10) { // format Y-m-d saja
            $tanggalMaintenance .= ' ' . Carbon::now('Asia/Jakarta')->format('H:i:s');
        }

        $validatedData = [
            'aset_id' => $request->aset_id,
            'jenis_maintenance' => $request->jenis_maintenance,
            'tanggal_maintenance' => $tanggalMaintenance,
            'deskripsi' => $request->deskripsi,
            'biaya' => $request->biaya,
            'teknisi' => $request->teknisi,
            'status' => $request->status,
            'catatan' => $request->catatan,
            'created_by' => auth()->id(),
        ];

        Maintenance::create($validatedData);

        // Update aset status
        $aset = Aset::find($request->aset_id);
        if ($request->status == 'proses') {
            $aset->update(['status' => 'maintenance']);
        } elseif ($request->status == 'selesai') {
            $aset->update(['status' => 'tersedia']);
        }

        return redirect()->route('maintenance.index')
            ->with('success', 'Maintenance berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Maintenance $maintenance)
    {
        $maintenance->load(['aset', 'user']);
        return view('maintenance.show', compact('maintenance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Maintenance $maintenance)
    {
        $asets = Aset::where('status', '!=', 'hilang')->get();
        return view('maintenance.edit', compact('maintenance', 'asets'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Maintenance $maintenance)
    {
        $request->validate([
            'aset_id' => 'required|exists:asets,id',
            'jenis_maintenance' => 'required|in:preventif,korektif,emergency',
            'tanggal_maintenance' => 'required|date',
            'deskripsi' => 'required|string',
            'biaya' => 'required|numeric|min:0',
            'teknisi' => 'required|string|max:255',
            'status' => 'required|in:pending,proses,selesai,dibatalkan',
            'catatan' => 'nullable|string'
        ]);

        $oldStatus = $maintenance->status;

        $maintenance->update([
            'aset_id' => $request->aset_id,
            'jenis_maintenance' => $request->jenis_maintenance,
            'tanggal_maintenance' => $request->tanggal_maintenance,
            'deskripsi' => $request->deskripsi,
            'biaya' => $request->biaya,
            'teknisi' => $request->teknisi,
            'status' => $request->status,
            'catatan' => $request->catatan
        ]);

        // Update aset status based on maintenance status change
        $aset = Aset::find($request->aset_id);
        if ($oldStatus != $request->status) {
            if ($request->status == 'proses') {
                $aset->update(['status' => 'maintenance']);
            } elseif ($request->status == 'selesai') {
                $aset->update(['status' => 'tersedia']);
            } elseif ($request->status == 'dibatalkan') {
                $aset->update(['status' => 'tersedia']);
            }
        }

        return redirect()->route('maintenance.index')
            ->with('success', 'Maintenance berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();

        return redirect()->route('maintenance.index')
            ->with('success', 'Maintenance berhasil dihapus!');
    }
}
