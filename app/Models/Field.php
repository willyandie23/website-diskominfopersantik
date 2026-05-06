<?php

namespace App\Models;

use App\Models\StructureOrganization;
use App\Traits\ModelLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Field extends Model
{
    use HasFactory, ModelLog ,SoftDeletes;

    protected $table = 'fields';
    protected $guarded = ['id'];

    // Optional: cast jika diperlukan
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi: Satu Bidang memiliki banyak Struktur Organisasi
     */
    public function structures()
    {
        return $this->hasMany(StructureOrganization::class, 'field_id');
    }

    // Helper (opsional)
    public function getNamaBidangAttribute($value)
    {
        return ucwords(strtolower($value));
    }
}
