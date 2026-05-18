<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KatalogFaq extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'katalog_faqs';

    protected $fillable = ['title', 'deskripsi'];
}
