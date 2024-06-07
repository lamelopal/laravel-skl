<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User;
        $user->name = "Gue Sipaling Admin";
        $user->email = "gue@admin.com";
        $user->level = "admin";
        $user->password = "12345678";
        $user->save();
    }
}
