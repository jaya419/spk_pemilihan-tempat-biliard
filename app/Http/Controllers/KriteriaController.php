<?php

namespace App\Http\Controllers;

use App\Models\kriterias;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index(){
        $kriterias = kriterias::all();
        return view('kriteria.index', compact('kriterias'));
    }

    public function create(){
        return view('kriteria.create');
    }

    public function store(Request $request){
    if (kriterias::count() >= 5) {
        return redirect()->route('kriteria.index')->with('error', 'Maksimal hanya 5 kriteria yang diperbolehkan.');
    }
        $request->validate([
            'nama' => 'required',
            'bobot' => 'required|numeric|min:1|max:100',
            'tipe' => 'required|in:cost,benefit',
        ]);

    $totalBobot = kriterias::sum('bobot') + $request->bobot;

    if ($totalBobot > 100) {
        return redirect()->route('kriteria.index')->with('error', 'Total bobot tidak boleh melebihi 100.');
    }
    kriterias::create($request->all());
    return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil ditambahkan.');
    }

    public function edit($id){
        $kriteria = kriterias::findOrFail($id);
        return view('kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'nama' => 'required',
            'bobot' => 'required|numeric|min:1|max:100',
            'tipe' => 'required|in:cost,benefit',
        ]);

    $kriteria = kriterias::findOrFail($id);
    
    $totalBobot = (kriterias::sum('bobot') - $kriteria->bobot) + $request->bobot;

    if ($totalBobot > 100) {
        return redirect()->route('kriteria.index')->with('error', 'Total bobot tidak boleh melebihi 100.');
    }

    $kriteria->update($request->all());
    return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil diupdate.');
    }

    public function destroy($id){
        $kriteria = kriterias::findOrFail($id);
        $kriteria->penilaians()->delete();
        $kriteria->delete();
        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil dihapus.'); 
    }   
}

