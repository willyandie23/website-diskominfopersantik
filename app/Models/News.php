<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';
    protected $guarded = ['id'];

    protected $casts = [
        'counter' => 'integer',
    ];

    /**
     * Relasi ke User (created_by)
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * URL gambar berita
     */
    public function getImageUrlAttribute()
    {
        return $this->image 
            ? Storage::url($this->image) 
            : asset('assets/images/no-image.png');
    }

    /**
     * Increment counter (untuk detail berita)
     */
    public function incrementCounter()
    {
        $this->increment('counter');
    }
}
