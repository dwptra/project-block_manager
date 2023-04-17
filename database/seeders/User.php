<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectManager extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        ProjectManager::create([
            'name' => 'Dwi',
            'email' => 'dwi@gmail.com',
            'password' => bcrypt('123'),   
        ]);
        ProjectManager::create([
            'name' => 'Daniel',
            'email' => 'daniel@gmail.com',
            'password' => bcrypt('123'),   
        ]);
    }
}
