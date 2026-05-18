<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tambah kolom nullable dulu
        Schema::table('votes', function (Blueprint $table) {
            $table->foreignId('pertanyaan_id')->nullable()->after('id')->constrained('pertanyaans')->onDelete('cascade');
        });
        // Insert pertanyaan default dari website lama
        $pertanyaanId = DB::table('pertanyaans')->insertGetId([
            'pertanyaan' => 'Bagaimana menurut anda kinerja Diskominfostandi Kabupaten Katingan selama masa pandemi Covid-19 dalam melaksanakan tugas, pokok dan fungsinya selaku Organisasi Pemerintah Daerah Kabupaten Katingan?',
            'is_active' => false, // pertanyaan lama, nonaktifkan
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Assign semua votes lama ke pertanyaan default
        DB::table('votes')->whereNull('pertanyaan_id')->update([
            'pertanyaan_id' => $pertanyaanId,
        ]);
        // Ubah kolom jadi NOT NULL setelah semua data ter-assign
        Schema::table('votes', function (Blueprint $table) {
            $table->foreignId('pertanyaan_id')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('votes', function (Blueprint $table) {
            $table->dropForeign(['pertanyaan_id']);
            $table->dropColumn('pertanyaan_id');
        });
        // Hapus pertanyaan default
        DB::table('pertanyaans')->where('id', 1)->delete();
    }
};
