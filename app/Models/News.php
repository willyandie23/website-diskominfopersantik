<?php

namespace App\Models;

use App\Traits\ModelLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    use HasFactory, ModelLog;

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
        if (empty($this->image)) {
            return asset('assets/images/no-image.png');
        }

        $image = trim($this->image);

        // Case 1: Sudah full path (format baru)
        if (str_starts_with($image, 'uploads/news/')) {
            return Storage::url($image);
        }

        // Case 2: Hanya nama file dengan folder di dalamnya (jarang)
        if (str_contains($image, 'uploads/news/')) {
            return Storage::url($image);
        }

        // Case 3: Format lama (hanya nama file) → tambahkan prefix
        return Storage::url('uploads/news/' . $image);
    }

    /**
     * Increment counter (untuk detail berita)
     */
    public function incrementCounter()
    {
        $this->increment('counter');
    }
}
