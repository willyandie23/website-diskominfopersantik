<?php

namespace App\Models;

use App\Traits\ModelLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory, ModelLog;

    protected $table = 'contacts';

    protected $guarded = ['id'];

    protected $fillable = [
        'nama',
        'email',
        'subjek',
        'isi'
    ];
}
