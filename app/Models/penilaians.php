<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penilaians extends Model
{
    protected $fillable = ['karyawan_id', 'kriteria_id', 'nilai'];

    public function karyawan(){
        return $this->belongsTo(karyawans::class);
    }

    public function kriteria(){
        return $this->belongsTo(kriterias::class);
    }
}
