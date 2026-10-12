<?php

namespace App\Http\Controllers;

use App\Models\Sertifikat;
use App\Models\Tanah;
use Illuminate\Http\Request;

class SertifikatController extends Controller
{
    public function index()
    {
        $sertifikats = Sertifikat::with('tanah')->get();
        return view('sertifikats.index', compact('sertifikats'));
    }

    public function create()
    {
        $tanahs = Tanah::doesntHave('sertifikat')->get();
        return view('sertifikats.create', compact('tanahs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_sertifikat' => 'required|unique:sertifikats,nomor_sertifikat',
            'tanggal_terbit' => 'nullable|date',
            'nomor_aiw' => 'nullable|string',
            'tanggal_aiw' => 'nullable|date',
            'tanah_id' => 'required|unique:sertifikats,tanah_id|exists:tanahs,id',
        ]);
        $sertifikat = Sertifikat::create($validated);
        $namaTanah = $sertifikat->tanah->nama ?? '-';
        return redirect()->route('sertifikats.index')->with('success', "Sertifikat {$namaTanah} berhasil ditambahkan.");
    }

    public function show(Sertifikat $sertifikat)
    {
        return view('sertifikats.show', compact('sertifikat'));
    }

    public function edit(Sertifikat $sertifikat)
    {
        $tanahs = Tanah::doesntHave('sertifikat')->orWhere('id', $sertifikat->tanah_id)->get();
        return view('sertifikats.edit', compact('sertifikat', 'tanahs'));
    }

    public function update(Request $request, Sertifikat $sertifikat)
    {
        $validated = $request->validate([
            'nomor_sertifikat' => 'required|unique:sertifikats,nomor_sertifikat,' . $sertifikat->id,
            'tanggal_terbit' => 'nullable|date',
            'nomor_aiw' => 'nullable|string',
            'tanggal_aiw' => 'nullable|date',
            'tanah_id' => 'required|unique:sertifikats,tanah_id,' . $sertifikat->id . '|exists:tanahs,id',
        ]);
        $sertifikat->update($validated);
        $namaTanah = $sertifikat->tanah->nama ?? '-';
        return redirect()->route('sertifikats.index')->with('success', "Sertifikat {$namaTanah} berhasil diupdate.");
    }

    public function destroy(Sertifikat $sertifikat)
    {
        $sertifikat->delete();
       $namaTanah = $sertifikat->tanah->nama ?? '-';
        return redirect()->route('sertifikats.index')->with('success', "Sertifikat {$namaTanah} berhasil dihapus.");
    }
}
