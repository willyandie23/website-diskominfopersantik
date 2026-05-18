<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KatalogLayanan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'katalog_layanan';

    protected $fillable = [
        'title',
        'deskripsi',
        'image',
        'url_video',
        'url_website',
    ];
}
