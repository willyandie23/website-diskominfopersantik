<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistics extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database
     */
    protected $table = 'statistics';

    /**
     * Kolom yang boleh diisi massal
     */
    protected $fillable = [
        'ip',
        'os',
        'browser',
    ];

    /**
     * Casts untuk tipe data
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Helper: Menampilkan informasi pengunjung secara ringkas
     */
    public function getVisitorInfoAttribute()
    {
        return "{$this->ip} | {$this->os} | {$this->browser}";
    }
}
