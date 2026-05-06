<?php

namespace App\Models;

use App\Traits\ModelLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cases extends Model
{
    use HasFactory, ModelLog, SoftDeletes;

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
}
