<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = 'Natnaell';
        $user->email = 'admin1@gmail.com';
        $user->password = bcrypt('mimin');
        $user->role = 'admin';

        $user->save();
    }
}
