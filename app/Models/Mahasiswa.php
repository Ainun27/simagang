<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use App\Traits\EncryptionTrait;

class Mahasiswa extends Model
{
    use Uuid, EncryptionTrait;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'mahasiswa';
    
    protected $fillable = [
        'nim', 
        'nama', 
        'email', 
        'no_hp',
        'universitas', 
        'divisi_id',
        'tanggal_mulai',      // ← TAMBAH INI
        'tanggal_selesai',    // ← TAMBAH INI
        'is_active'
    ];

    // Kolom yang akan dienkripsi otomatis
    protected $encryptable = ['nim', 'email', 'no_hp'];

    // Default values
    protected $attributes = [
        'is_active' => true
    ];
    
    // Casting untuk tipe data
    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'is_active' => 'boolean'
    ];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    // Helper untuk status aktif
    public function getStatusTextAttribute()
    {
        return $this->is_active ? 'Aktif' : 'Nonaktif';
    }

    public function getStatusBadgeAttribute()
    {
        return $this->is_active 
            ? '<span class="badge badge-success"><i class="fas fa-check-circle"></i> Aktif</span>'
            : '<span class="badge badge-danger"><i class="fas fa-times-circle"></i> Nonaktif</span>';
    }

    // Helper untuk cek apakah masa magang sudah berakhir
    public function getIsExpiredAttribute()
    {
        if (!$this->tanggal_selesai) {
            return false;
        }
        
        return now()->gt(\Carbon\Carbon::parse($this->tanggal_selesai));
    }

    // Helper untuk sisa hari magang
    public function getSisaHariAttribute()
    {
        if (!$this->tanggal_selesai) {
            return null;
        }
        
        $today = now();
        $selesai = \Carbon\Carbon::parse($this->tanggal_selesai);
        
        if ($selesai->lt($today)) {
            return -1; // Sudah lewat
        }
        
        return $today->diffInDays($selesai);
    }

    // Format masa magang
    public function getMasaMagangTextAttribute()
    {
        if (!$this->tanggal_mulai || !$this->tanggal_selesai) {
            return '-';
        }
        
        $mulai = \Carbon\Carbon::parse($this->tanggal_mulai);
        $selesai = \Carbon\Carbon::parse($this->tanggal_selesai);
        $hari = $mulai->diffInDays($selesai);
        
        return $this->formatMasaMagang($hari);
    }

    private function formatMasaMagang($hari)
    {
        if ($hari >= 365) {
            $tahun = floor($hari / 365);
            $sisaHari = $hari % 365;
            
            if ($sisaHari >= 30) {
                $bulan = floor($sisaHari / 30);
                return "{$tahun} tahun {$bulan} bulan";
            }
            return "{$tahun} tahun";
        }
        
        if ($hari >= 30) {
            $bulan = floor($hari / 30);
            $sisaHari = $hari % 30;
            
            if ($sisaHari > 0) {
                return "{$bulan} bulan {$sisaHari} hari";
            }
            return "{$bulan} bulan";
        }
        
        return "{$hari} hari";
    }

    // Scope untuk filter
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

    public function skills()
    {
        return $this->hasMany(MahasiswaSkill::class);
    }

    // AI Matching: Hitung compatibility dengan divisi
    public function getCompatibilityScore($divisi_id)
    {
        $divisi = Divisi::with('skillRequirements')->find($divisi_id);
        
        if (!$divisi || $divisi->skillRequirements->count() == 0) {
            return 0;
        }

        $totalScore = 0;
        $totalWeight = $divisi->skillRequirements->sum('weight');
        
        foreach ($divisi->skillRequirements as $requirement) {
            $mahasiswaSkill = $this->skills()
                ->where('skill_name', $requirement->skill_name)
                ->first();
            
            if ($mahasiswaSkill) {
                // Hitung score berdasarkan level
                $score = ($mahasiswaSkill->level_score / $requirement->min_level_score) * 100;
                $score = min($score, 100); // Cap at 100
                
                // Apply weight
                $totalScore += ($score * $requirement->weight);
            } else {
                // Tidak punya skill yang required
                if ($requirement->is_required) {
                    return 0; // Auto reject jika required skill tidak ada
                }
            }
        }
        
        return $totalWeight > 0 ? round($totalScore / $totalWeight) : 0;
    }

    // AI: Rekomendasi divisi terbaik
    public function getRecommendedDivisi($limit = 3)
    {
        $divisi = Divisi::with('skillRequirements')->get();
        $recommendations = [];
        
        foreach ($divisi as $div) {
            $score = $this->getCompatibilityScore($div->id);
            if ($score > 0) {
                $recommendations[] = [
                    'divisi' => $div,
                    'score' => $score
                ];
            }
        }
        
        // Sort by score descending
        usort($recommendations, fn($a, $b) => $b['score'] <=> $a['score']);
        
        return array_slice($recommendations, 0, $limit);
    }
}