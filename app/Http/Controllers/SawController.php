<?php

namespace App\Http\Controllers;

use App\Models\karyawans;
use App\Models\kriterias;
use App\Models\penilaians;

class SawController extends Controller
{
    public function hitungSaw(){
    $karyawans = karyawans::all();
    $kriterias = kriterias::all();

    $hasil = [];

    foreach ($karyawans as $karyawan) {
        $total = 0;

        foreach ($kriterias as $kriteria) {
            $penilaian = penilaians::where('karyawan_id', $karyawan->id)
                                   ->where('kriteria_id', $kriteria->id)
                                   ->first();
            $nilai = $penilaian ? $penilaian->nilai : 0;
            if ($kriteria->tipe === 'benefit') {
                $nilaiMaks = penilaians::where('kriteria_id', $kriteria->id)->max('nilai') ?: 1;
                $normalisasi = $nilaiMaks > 0 ? $nilai / $nilaiMaks : 0;
            } else {
                $nilaiMin = penilaians::where('kriteria_id', $kriteria->id)->min('nilai') ?: 1;           
                $normalisasi = $nilai > 0 ? $nilaiMin / $nilai : 0;
            }
            $bobotDesimal = $kriteria->bobot / 100;
            $total += $normalisasi * $bobotDesimal;
        }

        $skor = $total * 100;

        $hasil[] = [
            'karyawan' => $karyawan->nama,
            'skor' => round($skor, 2)
        ];
    }
        usort($hasil, fn($a, $b) => $b['skor'] <=> $a['skor']);
        return view('hasil.index', compact('hasil'));
    }

    public function beranda(){
        $jumlahKaryawan = karyawans::count();
        $jumlahKriteria = kriterias::count();
        $jumlahPenilaian = penilaians::count();

        $penilaianTerbaru = penilaians::latest()->take(1)->first();
        $kriteriaTerbaru = kriterias::latest()->take(1)->first();
        $karyawanTerbaru = karyawans::latest()->take(1)->first();

        return view('beranda.index', compact(
            'jumlahKaryawan', 'jumlahKriteria', 'jumlahPenilaian',
            'penilaianTerbaru', 'kriteriaTerbaru', 'karyawanTerbaru'
        ));
    }
}
