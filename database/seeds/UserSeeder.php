<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // "calculation_type_ud" set default on migration: "with_tax"
        $usersJons = file_get_contents('./database/seeds/strings/users.json');
        $usersArray = json_decode($usersJons, true);
        foreach ($usersArray as  $user) {
            User::create([
                'username' => $user['username'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
            ]);
        }
    }
}
