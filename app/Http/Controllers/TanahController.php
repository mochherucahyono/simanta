<?php
namespace App\Http\Controllers;

use App\Models\Tanah;
use App\Models\Jenis;
use App\Models\Desa;
use App\Models\Nadzir;
use Illuminate\Http\Request;

class TanahController extends Controller
{
    public function index()
    {
        $tanahs = Tanah::with(['jenis', 'desa', 'nadzir'])->get();
        return view('tanahs.index', compact('tanahs'));
    }

    public function create()
    {
        $jenis = Jenis::all();
        $desas = Desa::all();
        $nadzirs = Nadzir::all();
        return view('tanahs.create', compact('jenis', 'desas', 'nadzirs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_id' => 'required|exists:jenises,id',
            'nama' => 'required|string',
            'luas' => 'required|numeric',
            'wakif' => 'nullable|string',
            'alamat' => 'required|string',
            'desa_id' => 'required|exists:desas,id',
            'nadzir_id' => 'required|exists:nadzirs,id',
        ]);
        Tanah::create($validated);
        return redirect()->route('tanahs.index')->with('success', "Data {$validated['nama']} berhasil ditambahkan.");
    }

    public function show(Tanah $tanah)
    {
        return view('tanahs.show', compact('tanah'));
    }

    public function edit(Tanah $tanah)
    {
        $jenis = Jenis::all();
        $desas = Desa::all();
        $nadzirs = Nadzir::all();
        return view('tanahs.edit', compact('tanah', 'jenis', 'desas', 'nadzirs'));
    }

    public function update(Request $request, Tanah $tanah)
    {
        $validated = $request->validate([
            'jenis_id' => 'required|exists:jenises,id',
            'nama' => 'required|string',
            'luas' => 'required|numeric',
            'wakif' => 'nullable|string',
            'alamat' => 'required|string',
            'desa_id' => 'required|exists:desas,id',
            'nadzir_id' => 'required|exists:nadzirs,id',
        ]);
        $tanah->update($validated);
        return redirect()->route('tanahs.index')->with('success', "Data {$validated['nama']} berhasil diupdate.");
    }

    public function destroy(Tanah $tanah)
    {
        $tanah->delete();
        return redirect()->route('tanahs.index')->with('success', "Data {$tanah['nama']} berhasil dihapus.");
    }
    public function tampil_jenis_tanah()
    {
        $jenisList = Jenis::with('tanahs')->get();
        return view('jenis.tampil_jenis_tanah', compact('jenisList'));
    }
    public function tampil_desa_tanah()
    {
        $desaList = Desa::with(['tanahs.jenis', 'tanahs.nadzir'])->get();
        return view('desa.tampil_desa_tanah', compact('desaList'));
    }

    public function tampil_nadzir_tanah()
    {
        $nadzirList = Nadzir::with(['tanahs.jenis', 'tanahs.desa'])->get();
        return view('nadzir.tampil_nadzir_tanah', compact('nadzirList'));
    }
}