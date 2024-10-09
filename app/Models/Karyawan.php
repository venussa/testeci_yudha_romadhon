<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    
    public $table = 'karyawan';

    public $primaryKey = 'id_karyawan';

    public $fillable = [
        'id_karyawan',
        'nik',
        'nama',
        'ttl',
        'alamat',
        'id_jabatan',
        'id_dept',
        'id_level'
    ];

    public $validation = [
        'create' => [
            'nik' => 'required|string|size:10|unique:karyawan,nik',
            'nama' => 'required',
            'ttl' => 'required',
            'alamat' => 'required',
            'id_jabatan' => 'required|numeric|exists:jabatan,id_jabatan',
            'id_dept' => 'required|numeric|exists:department,id_dept',
            'id_level' => 'required|numeric|exists:level,id_level'
        ],
        'update' => [
            'id_karyawan' => 'required|numeric',
            'nik' => 'required|string|size:10|unique:karyawan,nik,{id}',
            'nama' => 'required',
            'ttl' => 'required',
            'alamat' => 'required',
            'id_jabatan' => 'required|numeric|exists:jabatan,id_jabatan',
            'id_dept' => 'required|numeric|exists:department,id_dept',
            'id_level' => 'required|numeric|exists:level,id_level'
        ],
    ];

    public $moreColumn = ['jabatan', 'department', 'level'];

    public $timestamps = false; 

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan');
    }

    public function level()
    {
        return $this->belongsTo(Level::class, 'id_level');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'id_dept');
    }
}