<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AsetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asets = Aset::with(['kategori', 'maintenances'])->orderBy('created_at', 'desc')->get();
        return view('aset.index', compact('asets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('aset.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_aset' => 'required|string|max:255|unique:asets',
            'nama_aset' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'deskripsi' => 'nullable|string',
            'lokasi' => 'nullable|string|max:255',
            'tanggal_pembelian' => 'nullable|date',
            'harga' => 'nullable|numeric|min:0',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'status' => 'required|in:Tersedia,Dipinjam,Maintenance',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
            'kode_aset' => $request->kode_aset,
            'nama_aset' => $request->nama_aset,
            'kategori_id' => $request->kategori_id,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'tanggal_pembelian' => $request->tanggal_pembelian,
            'harga' => $request->harga,
            'kondisi' => $request->kondisi,
            'status' => $request->status,
            'user_id' => auth()->id()
        ];

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambarName = time() . '_' . $gambar->getClientOriginalName();
            $gambar->storeAs('public/aset', $gambarName);
            $data['gambar'] = 'aset/' . $gambarName;
        }

        Aset::create($data);

        return redirect()->route('aset.index')
            ->with('success', 'Aset berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Aset $aset)
    {
        $aset->load(['kategori', 'maintenances']);
        return view('aset.show', compact('aset'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aset $aset)
    {
        $kategoris = Kategori::all();
        return view('aset.edit', compact('aset', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aset $aset)
    {
        $request->validate([
            'kode_aset' => 'required|string|max:255|unique:asets,kode_aset,' . $aset->id,
            'nama_aset' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'deskripsi' => 'nullable|string',
            'lokasi' => 'nullable|string|max:255',
            'tanggal_pembelian' => 'nullable|date',
            'harga' => 'nullable|numeric|min:0',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'status' => 'required|in:Tersedia,Dipinjam,Maintenance',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
            'kode_aset' => $request->kode_aset,
            'nama_aset' => $request->nama_aset,
            'kategori_id' => $request->kategori_id,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'tanggal_pembelian' => $request->tanggal_pembelian,
            'harga' => $request->harga,
            'kondisi' => $request->kondisi,
            'status' => $request->status
        ];

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            // Delete old gambar
            if ($aset->gambar) {
                Storage::delete('public/' . $aset->gambar);
            }

            $gambar = $request->file('gambar');
            $gambarName = time() . '_' . $gambar->getClientOriginalName();
            $gambar->storeAs('public/aset', $gambarName);
            $data['gambar'] = 'aset/' . $gambarName;
        }

        $aset->update($data);

        return redirect()->route('aset.show', $aset->id)
            ->with('success', 'Aset berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aset $aset)
    {
        // Delete gambar if exists
        if ($aset->gambar) {
            Storage::delete('public/' . $aset->gambar);
        }

        $aset->delete();

        return redirect()->route('aset.index')
            ->with('success', 'Aset berhasil dihapus!');
    }
}
