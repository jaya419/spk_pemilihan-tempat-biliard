<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kriterias extends Model
{
    protected $fillable = ['nama', 'bobot', 'tipe'];

    public function penilaians(){
    return $this->hasMany(Penilaians::class, 'kriteria_id');
    }
}
