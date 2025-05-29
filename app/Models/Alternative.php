<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'contact',
        'description',
        'open_hour',
        'close_hour',
    ];

    // Relasi ke scores
    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}
