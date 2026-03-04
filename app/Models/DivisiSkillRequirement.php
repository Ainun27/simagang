<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DivisiSkillRequirement extends Model
{
    protected $fillable = [
        'divisi_id',
        'skill_name',
        'min_level',
        'is_required',
        'weight'
    ];

    protected $casts = [
        'is_required' => 'boolean'
    ];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function getMinLevelScoreAttribute()
    {
        return match($this->min_level) {
            'beginner' => 25,
            'intermediate' => 50,
            'advanced' => 75,
            'expert' => 100
        };
    }
}