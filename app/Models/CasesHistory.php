<?php

namespace App\Models;

// use App\Traits\ModelLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use Illuminate\Database\Eloquent\SoftDeletes;

class CasesHistory extends Model
{
    use HasFactory;

    protected $table = 'helpdesk_of_cases_history';

    public $timestamps = false;

    protected $fillable = [
        'ref_id',
        'status'
    ];

    /**
     * Keluhan yang dimiliki oleh history ini.
     * ref_id di tabel ini merujuk ke id di tabel helpdesk_of_cases.
     */
    public function case(): BelongsTo
    {
        return $this->belongsTo(Cases::class, 'ref_id', 'id');
    }
}