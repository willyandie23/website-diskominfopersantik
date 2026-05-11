<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequestHistory extends Model
{
    use HasFactory;

    protected $table = 'helpdesk_of_requests_history';

    public $timestamps = false;

    protected $fillable = [
        'ref_id',
        'status'
    ];

    /**
     * Pengajuan yang dimiliki oleh history ini.
     */
    public function request(): BelongsTo
    {
        return $this->belongsTo(Requests::class, 'ref_id', 'id');
    }
}