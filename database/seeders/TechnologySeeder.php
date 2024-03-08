<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Technology;

// Helpers
use Illuminate\Support\Facades\Schema;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            Technology::truncate();
        });

        $allTechnologies = [
            'Adobe Photoshop',
            'Adobe Illustrator',
            'Adobe InDesign',
            'Figma',
            'Blender',
            'VsCode',
            'Adobe Premiere'
        ];

        foreach ($allTechnologies as $singleTechnology) {
            $technology = Technology::create([
                'title' => $singleTechnology,
                'slug' => str()->slug($singleTechnology),
            ]);
        }
    }
}
