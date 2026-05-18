<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pertanyaan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pertanyaans';
    
    protected $fillable = [
        'pertanyaan',
        'is_active',
    ];
    protected $casts = [
        'is_active' => 'boolean',
    ];
    public function votes()
    {
        return $this->hasMany(Votes::class, 'pertanyaan_id');
    }
}
