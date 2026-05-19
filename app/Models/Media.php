<?php

namespace App\Models;

use App\Traits\ModelLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasFactory, ModelLog;

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

    public function getFileUrlAttribute(): string
    {
        return $this->path 
            ? Storage::url($this->path) 
            : asset('frontend/images/default.jpg');
    }

    public function getFileTypeIconAttribute(): string
    {
        $mime = $this->file ?? '';

        if (str_starts_with($mime, 'image/')) {
            return 'mdi mdi-image';
        }
        if (str_contains($mime, 'pdf')) {
            return 'mdi mdi-file-pdf-box';
        }
        if (str_contains($mime, 'word') || str_contains($mime, 'document')) {
            return 'mdi mdi-file-word';
        }
        if (str_contains($mime, 'excel') || str_contains($mime, 'spreadsheet')) {
            return 'mdi mdi-file-excel';
        }
        if (str_contains($mime, 'presentation')) {
            return 'mdi mdi-file-powerpoint';
        }
        return 'mdi mdi-file-download';
    }

    public function getFileSizeFormattedAttribute(): string
    {
        // Kalau kamu simpan ukuran file di kolom 'size' (dalam byte)
        if (isset($this->size)) {
            $units = ['B', 'KB', 'MB', 'GB'];
            $bytes = $this->size;
            $i = 0;
            while ($bytes > 1024) {
                $bytes /= 1024;
                $i++;
            }
            return round($bytes, 1) . ' ' . $units[$i];
        }
        return '';
    }
}