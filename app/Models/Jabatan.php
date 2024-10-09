<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    
    public $table = 'jabatan';

    public $primaryKey = 'id_jabatan';

    public $fillable = [
        'nama_jabatan',
        'id_jabatan'
    ];

    public $validation = [
        'create' => [
            'nama_jabatan' => 'required|unique:jabatan,nama_jabatan'
        ],
        'update' => [
            'id_jabatan' => 'required|numeric',
            'nama_jabatan' => 'required|unique:jabatan,nama_jabatan,{id}'
        ]
    ];

    public $timestamps = false; 
}