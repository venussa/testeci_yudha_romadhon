<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id('id_karyawan');
            $table->string('nik', 10)->unique();
            $table->string('nama', 100);
            $table->date('ttl');
            $table->text('alamat');
            $table->foreignId('id_jabatan')->constrained('jabatan', 'id_jabatan');
            $table->foreignId('id_dept')->constrained('department', 'id_dept');
            $table->foreignId('id_level')->constrained('level', 'id_level');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};
