<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MahasiswaSkill extends Model
{
    protected $fillable = [
        'mahasiswa_id',
        'skill_name',
        'skill_level',
        'years_experience'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    // Helper untuk konversi level ke score
    public function getLevelScoreAttribute()
    {
        return match($this->skill_level) {
            'beginner' => 25,
            'intermediate' => 50,
            'advanced' => 75,
            'expert' => 100
        };
    }
}