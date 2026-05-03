<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $table = 'medias';
    protected $guarded = ['id'];

    // =============================================
    // QUERY SCOPES
    // =============================================
    public function scopeBanner($query)
    {
        return $query->where('slide_show', 1)
                    ->where('file', 'like', 'image/%');
    }

    public function scopeGallery($query)
    {
        return $query->where('slide_show', 0)
                    ->where('file', 'like', 'image/%');
    }

    public function scopeDownload($query)
    {
        return $query->where('slide_show', 0)
                    ->where('file', 'not like', 'image/%');
    }

    // Helper agar lebih mudah dipakai di view & controller
    public function getIsBannerAttribute(): bool
    {
        return $this->slide_show === 1 && str_starts_with($this->file, 'image/');
    }

    public function getIsDownloadAttribute(): bool
    {
        return $this->slide_show === 0 && !str_starts_with($this->file, 'image/');
    }
}