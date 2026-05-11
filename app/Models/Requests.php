<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Requests extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'helpdesk_of_requests';

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
        'file_surat_pengantar',  // wajib
        'file_addition1',        // opsional
        'file_addition2',        // opsional
        'file_addition3',        // opsional
    ];

    /**
     * Semua riwayat status dari pengajuan ini.
     */
    public function histories(): HasMany
    {
        return $this->hasMany(RequestHistory::class, 'ref_id', 'id');
    }

    /**
     * Riwayat status terbaru dari pengajuan ini.
     */
    public function latestHistory(): HasOne
    {
        return $this->hasOne(RequestHistory::class, 'ref_id', 'id')
                    ->latestOfMany('id');
    }
}