<?php

namespace App\Models;

use App\Traits\ModelLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Requests extends Model
{
    use HasFactory, ModelLog, SoftDeletes;

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
        'file_surat_pengantar',
        'file_addition1',
        'file_addition2',
        'file_addition3',
        ];
}
