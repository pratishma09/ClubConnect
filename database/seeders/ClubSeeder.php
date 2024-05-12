<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Deerwalk Literature Society',
            'email' => 'dls@deerwalk.edu.np',
            'password' => Hash::make('password'),
            'role' => 'club',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
