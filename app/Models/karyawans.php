<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class karyawans extends Model
{
    protected $fillable = ['nama' , 'email' ,'telepon' , 'alamat'];

    public function penilaians(){
        return $this->hasMany(penilaians::class);
    }
}
