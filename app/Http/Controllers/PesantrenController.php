<?php

namespace App\Http\Controllers;

use App\Models\Pesantren;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PesantrenController extends Controller
{
    public function index()
    {
        $pesantren = Pesantren::first();
        return view('pesantren.index', compact('pesantren'));
    }

    public function edit()
    {
        $pesantren = Pesantren::first();
        return view('pesantren.edit', compact('pesantren'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_pesantren' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'deskripsi' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tahun_berdiri' => 'nullable|integer|min:1900|max:' . date('Y'),
            'jumlah_santri' => 'nullable|integer|min:0',
            'jumlah_ustadz' => 'nullable|integer|min:0',
        ]);

        $pesantren = Pesantren::first();

        if (!$pesantren) {
            $pesantren = new Pesantren();
        }

        $data = $request->except('logo');

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($pesantren->logo) {
                Storage::delete('public/' . $pesantren->logo);
            }

            $logo = $request->file('logo');
            $logoName = time() . '_' . $logo->getClientOriginalName();
            $logo->storeAs('public/pesantren', $logoName);
            $data['logo'] = 'pesantren/' . $logoName;
        }

        $pesantren->fill($data);
        $pesantren->save();

        return redirect()->route('pesantren.index')
            ->with('success', 'Profil pesantren berhasil diperbarui!');
    }
}
