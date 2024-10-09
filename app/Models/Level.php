<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;
    
    public $table = 'level';

    public $primaryKey = 'id_level';

    public $fillable = [
        'nama_level',
        'id_level'
    ];

    public $validation = [
        'create' => [
            'nama_level' => 'required|unique:level,nama_level'
        ],
        'update' => [
            'id_level' => 'required|numeric',
            'nama_level' => 'required|unique:level,nama_level,{id}'
        ]
    ];

    public $timestamps = false; 
}