<?php

namespace App\Http\Controllers;

use App\Models\karyawans;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index(Request $request){
        $query = karyawans::query();

        if ($request->has('q') && !empty($request->q)) {
            $search = $request->q;
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('telepon', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%");
        }

        $karyawans = $query->get();
        return view('karyawan.index', compact('karyawans'));
    }

    public function create(){
        return view('karyawan.create');
    }

    public function store(Request $request){
    $request->validate([
        'nama' => 'required|string|max:255|unique:karyawans,nama',
        'email' => 'required|email|max:255|unique:karyawans,email',
        'telepon' => 'required|string|max:20|unique:karyawans,telepon',
        'alamat' => 'required|string',
    ]);

    $exists = karyawans::where('nama', $request->nama)
        ->where('email', $request->email)
        ->where('telepon', $request->telepon)
        ->exists();

    if ($exists) {
        return redirect()->back()->withInput()->withErrors([
            'duplicate' => 'Data karyawan dengan nama, email, dan telepon tersebut sudah ada.'
        ]);
    }

    karyawans::create($request->all());
    return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan.');
    }

    public function edit($id){
        $karyawan = karyawans::findOrFail($id);
        return view('karyawan.edit', compact('karyawan'));
    }

    public function update(Request $request, $id){
    $request->validate([
        'nama' => 'required|string|max:255|unique:karyawans,nama,' . $id,
        'email' => 'required|email|max:255|unique:karyawans,email,' . $id,
        'telepon' => 'required|string|max:20|unique:karyawans,telepon,' . $id,
        'alamat' => 'required|string',
    ]);

    $exists = karyawans::where('id', '!=', $id)
        ->where('nama', $request->nama)
        ->where('email', $request->email)
        ->where('telepon', $request->telepon)
        ->exists();

    if ($exists) {
        return redirect()->back()->withInput()->withErrors([
            'duplicate' => 'Data karyawan dengan nama, email, dan telepon tersebut sudah ada.'
        ]);
    }

    $karyawan = karyawans::findOrFail($id);
    $karyawan->update($request->all());
    return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil diupdate.');
    }

    public function destroy($id){
        $karyawan = karyawans::findOrFail($id);
        $karyawan->delete();
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus.');
    }
}