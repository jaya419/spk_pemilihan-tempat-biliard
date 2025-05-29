<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criterion extends Model
{
    use HasFactory;

    protected $table = 'criterias';

    protected $fillable = [
        'name',
        'type',
        'weight',
    ];

    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}
