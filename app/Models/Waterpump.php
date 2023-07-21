<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waterpump extends Model
{
    use HasFactory;

    
    protected $table = 'waterpumps';

    protected $fillable = [
        'input',
        'output',
        'constant',
        'level',
        'value',
    ];
}
