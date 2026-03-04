<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    protected $table = 'divisi';
    
    protected $fillable = [
        'nama_divisi',
        'deskripsi',
        'kuota'
    ];

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }

    public function getSisaKuotaAttribute()
{
    return $this->kuota - $this->mahasiswa()->where('is_active', 1)->count();
}

public function getPersentaseTerisiAttribute()
{
    if ($this->kuota == 0) return 0;

    $aktif = $this->mahasiswa()->where('is_active', 1)->count();

    return ($aktif / $this->kuota) * 100;
}


    // Helper status kuota
    public function getStatusKuotaAttribute()
    {
        $sisa = $this->sisa_kuota;
        if ($sisa == 0) return 'penuh';
        if ($sisa <= 2) return 'hampir_penuh';
        return 'tersedia';
    }

    public function skillRequirements()
{
    return $this->hasMany(DivisiSkillRequirement::class);
}

// Get matching mahasiswa by skill
public function getMatchingMahasiswa($minScore = 50)
{
    $allMahasiswa = Mahasiswa::with('skills')->get();
    $matching = [];
    
    foreach ($allMahasiswa as $mhs) {
        $score = $mhs->getCompatibilityScore($this->id);
        if ($score >= $minScore) {
            $matching[] = [
                'mahasiswa' => $mhs,
                'score' => $score
            ];
        }
    }
    
    usort($matching, fn($a, $b) => $b['score'] <=> $a['score']);
    
    return $matching;
}
}