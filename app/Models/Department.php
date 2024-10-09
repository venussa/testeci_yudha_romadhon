<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    
    public $table = 'department';

    public $primaryKey = 'id_dept';

    public $fillable = [
        'nama_dept',
        'id_dept'
    ];

    public $validation = [
        'create' => [
            'nama_dept' => 'required|unique:department,nama_dept'
        ],
        'update' => [
            'id_dept' => 'required|numeric',
            'nama_dept' => 'required|unique:department,nama_dept,{id}'
        ]
    ];

    public $timestamps = false; 
}