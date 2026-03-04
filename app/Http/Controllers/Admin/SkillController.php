<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\MahasiswaSkill;
use App\Models\Divisi;
use App\Models\DivisiSkillRequirement;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    // Manage mahasiswa skills
    public function editMahasiswaSkills(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load('skills', 'divisi');
        $commonSkills = $this->getCommonSkills();
        
        return view('admin.skills.mahasiswa-skills', compact('mahasiswa', 'commonSkills'));
    }

    public function storeMahasiswaSkill(Request $request, Mahasiswa $mahasiswa)
    {
        $validated = $request->validate([
            'skill_name' => 'required|string|max:255',
            'skill_level' => 'required|in:beginner,intermediate,advanced,expert',
            'years_experience' => 'required|integer|min:0|max:50'
        ]);

        $mahasiswa->skills()->create($validated);

        return back()->with('success', 'Skill berhasil ditambahkan!');
    }

    public function destroyMahasiswaSkill(MahasiswaSkill $skill)
    {
        $skill->delete();
        return back()->with('success', 'Skill berhasil dihapus!');
    }

    // AI Matching Dashboard
    public function aiMatching(Mahasiswa $mahasiswa)
    {
        $mahasiswa->load('skills', 'divisi');
        $recommendations = $mahasiswa->getRecommendedDivisi(5);
        
        return view('admin.skills.ai-matching', compact('mahasiswa', 'recommendations'));
    }

    // Divisi Skill Requirements
    public function editDivisiSkills(Divisi $divisi)
    {
        $divisi->load('skillRequirements');
        $commonSkills = $this->getCommonSkills();
        
        return view('admin.skills.divisi-skills', compact('divisi', 'commonSkills'));
    }

    public function storeDivisiSkill(Request $request, Divisi $divisi)
    {
        $validated = $request->validate([
            'skill_name' => 'required|string|max:255',
            'min_level' => 'required|in:beginner,intermediate,advanced,expert',
            'is_required' => 'boolean',
            'weight' => 'required|integer|min:1|max:10'
        ]);

        $divisi->skillRequirements()->create($validated);

        return back()->with('success', 'Skill requirement berhasil ditambahkan!');
    }

    public function destroyDivisiSkill(DivisiSkillRequirement $skill)
    {
        $skill->delete();
        return back()->with('success', 'Skill requirement berhasil dihapus!');
    }

    // AI Recommendations for Divisi
    public function divisiMatching(Divisi $divisi)
    {
        $divisi->load('skillRequirements');
        $matchingMahasiswa = $divisi->getMatchingMahasiswa(30); // Min 30% match
        
        return view('admin.skills.divisi-matching', compact('divisi', 'matchingMahasiswa'));
    }

    // Common skills database
    private function getCommonSkills()
    {
        return [
            'Programming' => [
                'PHP', 'Laravel', 'JavaScript', 'React', 'Vue.js', 'Node.js', 
                'Python', 'Django', 'Java', 'C++', 'Go', 'Ruby'
            ],
            'Database' => [
                'MySQL', 'PostgreSQL', 'MongoDB', 'Redis', 'SQL Server'
            ],
            'Design' => [
                'Figma', 'Adobe XD', 'Sketch', 'Adobe Photoshop', 'Adobe Illustrator',
                'User Research', 'Wireframing', 'Prototyping'
            ],
            'Marketing' => [
                'Social Media Marketing', 'Google Analytics', 'SEO', 'SEM',
                'Content Writing', 'Email Marketing', 'Copywriting'
            ],
            'Data Science' => [
                'Python', 'R', 'SQL', 'Excel', 'Power BI', 'Tableau',
                'Machine Learning', 'Data Visualization'
            ],
            'Network & Security' => [
                'Network Configuration', 'Cybersecurity', 'Linux', 'Windows Server',
                'Firewall', 'Penetration Testing', 'Ethical Hacking'
            ],
            'Soft Skills' => [
                'Communication', 'Teamwork', 'Problem Solving', 'Time Management',
                'Leadership', 'Critical Thinking'
            ]
        ];
    }
}