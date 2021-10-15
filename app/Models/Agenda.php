<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;
    
    static $rules = [
        'title' => 'required',
        'motivo' => 'required',
        'start' => 'required',
        'end' => 'required'
    ];

    protected $fillable = ['title', 'motivo', 'start', 'end'];
}
