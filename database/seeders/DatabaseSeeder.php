<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('level')->insert([
            ['nama_level' => 'Junior'],
            ['nama_level' => 'Middle'],
            ['nama_level' => 'Senior'],
        ]);

        DB::table('department')->insert([
            ['nama_dept' => 'Human Resources'],
            ['nama_dept' => 'IT'],
            ['nama_dept' => 'Finance'],
        ]);

        DB::table('jabatan')->insert([
            ['nama_jabatan' => 'Staff IT'],
            ['nama_jabatan' => 'Manager HR'],
            ['nama_jabatan' => 'Financial Analyst'],
        ]);

        DB::table('karyawan')->insert([
            [
                'nik' => '1234567890',
                'nama' => 'Andi',
                'ttl' => '1990-05-15',
                'alamat' => 'Jl. Merdeka No. 1',
                'id_jabatan' => 1,
                'id_dept' => 3,
                'id_level' => 2
            ],
            [
                'nik' => '0987654321',
                'nama' => 'Budi',
                'ttl' => '1985-08-22',
                'alamat' => 'Jl. Sudirman No. 10',
                'id_jabatan' => 2,
                'id_dept' => 1,
                'id_level' => 3
            ],
            [
                'nik' => '1122334455',
                'nama' => 'Citra',
                'ttl' => '1992-12-05',
                'alamat' => 'Jl. Diponegoro No. 5',
                'id_jabatan' => 3,
                'id_dept' => 2,
                'id_level' => 1
            ]
        ]);
    }
}
