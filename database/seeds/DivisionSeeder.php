<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $divisions = [
            "C Level & CEO Office",
            "People Development",
            "General Affair",
            "Marketing Communication",
            "CRM",
            "Engineer",
            "Commercial",
            "Creative",
            "Legal",
            "Finance",
            "Insight",
            "Tech Support",
            "Logistic Support",
        ];

        foreach ($divisions as $division) {
            \App\Division::create([
                'name' => $division,
            ]);
        }
    }
}
