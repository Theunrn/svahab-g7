<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Option = ['water','live','take_photo'];
        foreach($Option as $option) {
            \App\Models\Option::create(['option' => $option]);
        }
      
    }
}
