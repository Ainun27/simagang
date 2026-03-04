<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DivisiSkillRequirement;
use App\Models\Divisi;

class DivisiSkillRequirementSeeder extends Seeder
{
    public function run()
    {
        $divisi = Divisi::all();

        foreach ($divisi as $div) {
            switch ($div->nama_divisi) {
                case 'IT & Programmer':
                    DivisiSkillRequirement::create([
                        'divisi_id' => $div->id,
                        'skill_name' => 'PHP',
                        'min_level' => 'intermediate',
                        'is_required' => true,
                        'weight' => 3
                    ]);
                    DivisiSkillRequirement::create([
                        'divisi_id' => $div->id,
                        'skill_name' => 'Laravel',
                        'min_level' => 'intermediate',
                        'is_required' => true,
                        'weight' => 3
                    ]);
                    DivisiSkillRequirement::create([
                        'divisi_id' => $div->id,
                        'skill_name' => 'JavaScript',
                        'min_level' => 'beginner',
                        'is_required' => false,
                        'weight' => 2
                    ]);
                    DivisiSkillRequirement::create([
                        'divisi_id' => $div->id,
                        'skill_name' => 'MySQL',
                        'min_level' => 'beginner',
                        'is_required' => true,
                        'weight' => 2
                    ]);
                    break;

                case 'UI/UX Designer':
                    DivisiSkillRequirement::create([
                        'divisi_id' => $div->id,
                        'skill_name' => 'Figma',
                        'min_level' => 'intermediate',
                        'is_required' => true,
                        'weight' => 3
                    ]);
                    DivisiSkillRequirement::create([
                        'divisi_id' => $div->id,
                        'skill_name' => 'Adobe XD',
                        'min_level' => 'beginner',
                        'is_required' => false,
                        'weight' => 2
                    ]);
                    DivisiSkillRequirement::create([
                        'divisi_id' => $div->id,
                        'skill_name' => 'User Research',
                        'min_level' => 'intermediate',
                        'is_required' => true,
                        'weight' => 3
                    ]);
                    break;

                case 'Digital Marketing':
                    DivisiSkillRequirement::create([
                        'divisi_id' => $div->id,
                        'skill_name' => 'Social Media Marketing',
                        'min_level' => 'intermediate',
                        'is_required' => true,
                        'weight' => 3
                    ]);
                    DivisiSkillRequirement::create([
                        'divisi_id' => $div->id,
                        'skill_name' => 'Google Analytics',
                        'min_level' => 'beginner',
                        'is_required' => false,
                        'weight' => 2
                    ]);
                    DivisiSkillRequirement::create([
                        'divisi_id' => $div->id,
                        'skill_name' => 'Content Writing',
                        'min_level' => 'intermediate',
                        'is_required' => true,
                        'weight' => 3
                    ]);
                    break;

                case 'Data Analyst':
                    DivisiSkillRequirement::create([
                        'divisi_id' => $div->id,
                        'skill_name' => 'Python',
                        'min_level' => 'intermediate',
                        'is_required' => true,
                        'weight' => 3
                    ]);
                    DivisiSkillRequirement::create([
                        'divisi_id' => $div->id,
                        'skill_name' => 'SQL',
                        'min_level' => 'intermediate',
                        'is_required' => true,
                        'weight' => 3
                    ]);
                    DivisiSkillRequirement::create([
                        'divisi_id' => $div->id,
                        'skill_name' => 'Excel',
                        'min_level' => 'advanced',
                        'is_required' => true,
                        'weight' => 2
                    ]);
                    DivisiSkillRequirement::create([
                        'divisi_id' => $div->id,
                        'skill_name' => 'Power BI',
                        'min_level' => 'beginner',
                        'is_required' => false,
                        'weight' => 2
                    ]);
                    break;

                case 'Network & Security':
                    DivisiSkillRequirement::create([
                        'divisi_id' => $div->id,
                        'skill_name' => 'Network Configuration',
                        'min_level' => 'intermediate',
                        'is_required' => true,
                        'weight' => 3
                    ]);
                    DivisiSkillRequirement::create([
                        'divisi_id' => $div->id,
                        'skill_name' => 'Cybersecurity',
                        'min_level' => 'intermediate',
                        'is_required' => true,
                        'weight' => 3
                    ]);
                    DivisiSkillRequirement::create([
                        'divisi_id' => $div->id,
                        'skill_name' => 'Linux',
                        'min_level' => 'beginner',
                        'is_required' => false,
                        'weight' => 2
                    ]);
                    break;
            }
        }
    }
}