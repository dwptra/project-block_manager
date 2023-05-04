<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ProjectManager;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProjectManager::create([
            'name' => 'Dwi',
            'email' => 'dwi@gmail.com',
            'password' => bcrypt('123'),
            'role' => 'Admin',
        ]);
        
        ProjectManager::create([
            'name' => 'Daniel',
            'email' => 'daniel@gmail.com',
            'password' => bcrypt('123'),
            'role' => 'Project Manager',
        ]);
    }
}
