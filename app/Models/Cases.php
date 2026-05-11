<?php

namespace App\Models;

use App\Traits\ModelLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cases extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'helpdesk_of_cases';

    protected $fillable = [
        'status',
        'title',
        'category',
        'unit_name',
        'requester_name',
        'nip',
        'phone',
        'email',
        'deadline_by_requester',
        'assignee',
        'desc',
        'file_attachment',
        'costume_field',
        'created_by',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

    /**
     * Semua riwayat status dari keluhan ini.
     * ref_id di tabel history merujuk ke id di tabel ini.
     */
    public function histories(): HasMany
    {
        return $this->hasMany(CasesHistory::class, 'ref_id', 'id');
    }

    /**
     * Riwayat status terbaru dari keluhan ini.
     */
    public function latestHistory(): HasOne
    {
        return $this->hasOne(CasesHistory::class, 'ref_id', 'id')
                    ->latestOfMany();
    }
}