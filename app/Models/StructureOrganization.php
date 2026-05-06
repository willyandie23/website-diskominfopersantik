<?php

namespace App\Models;

use App\Traits\ModelLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class StructureOrganization extends Model
{
    use HasFactory, ModelLog ,SoftDeletes;

    protected $table = 'structure_organization';
    protected $guarded = ['id'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Relasi: Struktur Organisasi belongs to Bidang
     */
    public function field()
    {
        return $this->belongsTo(Field::class, 'field_id');
    }

    /**
     * Helper: Status Aktif / Non-Aktif
     */
    public function getStatusAttribute()
    {
        return $this->is_active ? 'Aktif' : 'Non-Aktif';
    }

    /**
     * Helper: URL Gambar
     */
    public function getGambarUrlAttribute()
    {
        return $this->gambar 
            ? asset('storage/' . $this->gambar) 
            : asset('assets/images/Dummy PP.jpg');
    }
}
