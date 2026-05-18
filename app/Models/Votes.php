<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Votes extends Model
{
    use HasFactory;

    protected $fillable = [
        'pertanyaan_id',
        'nilai_vote',
		'data_pengguna',
    ];

    protected $casts = [
        'data_pengguna' => 'array',
    ];
    
    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class, 'pertanyaan_id');
    }
}
