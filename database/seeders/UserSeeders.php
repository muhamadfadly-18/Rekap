<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            //colum table db => value
            'name' => "administrator",
            'email' => "admin@gmail.com",
            'role' => "admin",
            "password" => Hash::make("admin"),
            //cara lain ekpripsi : bcyrpt


        ]);
        User::create([
            'name' => "guru",
            'email' => "guru@gmail.com",
            'role' => "guru",
            "password" => Hash::make("guru"),


        ]);
    }
}
