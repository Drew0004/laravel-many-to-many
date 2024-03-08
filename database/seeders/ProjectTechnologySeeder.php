<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//Models
use App\Models\Project;
use App\Models\Technology;

use Illuminate\Support\Facades\DB;

class ProjectTechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        for ($i = 0; $i < 10; $i++) { 
            $randomProject = Project::inRandomOrder()->first();
            $randomTechnology = Technology::inRandomOrder()->first();
        
            // Verifico se la coppia esiste già nella tabella
            $existigData = DB::table('project_technology')
                ->where('project_id', $randomProject->id)
                ->where('technology_id', $randomTechnology->id)
                ->exists();
        
            // Se la coppia non esiste, inserisco il nuovo dato
            if (!$existigData) {
                DB::table('project_technology')->insert([
                    ['project_id' => $randomProject->id, 'technology_id' => $randomTechnology->id]
                ]);
            }
        }

        // DB::table('project_technology')->insert([
        //     ['project_id' => 1, 'technology_id' => 1],
        //     ['project_id' => 1, 'technology_id' => 1],
        // ]);
    }
}
