<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensory extends Model
{
    use HasFactory;

    protected $table = 'sensorys';

    protected $fillable = [
        'sensory1',
        'sensory2',
        'sensory3',
        'sensory4',
        'sensory5',
    ];
}
