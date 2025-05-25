<?php

namespace App\Http\Controllers;

use App\Models\karyawans;
use App\Models\kriterias;
use App\Models\penilaians;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index(){
        $karyawans = karyawans::all();
        $kriterias = kriterias::all();
        $penilaians = penilaians::all()->keyBy(function ($item) {
            return $item->karyawan_id . '-' . $item->kriteria_id;
        });

        return view('penilaian.index', compact('karyawans', 'kriterias', 'penilaians'));
    }

    public function store(Request $request){
    $request->validate([
        'karyawan_ids' => 'required|array',
        'karyawan_ids.*' => 'exists:karyawans,id',
        'nilai' => 'required|array',
        'nilai.*' => 'array',
        'nilai.*.*' => 'required|numeric|min:0|max:100',
    ]);

    foreach ($request->karyawan_ids as $karyawan_id) {
        foreach ($request->nilai[$karyawan_id] as $kriteria_id => $nilai) {
            penilaians::updateOrCreate(
                [
                    'karyawan_id' => $karyawan_id,
                    'kriteria_id' => $kriteria_id,
                ],
                [
                    'nilai' => $nilai,
                ]
            );
        }
    }
    return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil disimpan.');
    }
  
}