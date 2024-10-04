<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Ugo', 'email' => 'ugo@ugo.it', 'password' => Hash::make('12341234')],
            ['name' => 'Pino', 'email' => 'pino@pino.it', 'password' => Hash::make('12341234')],
            ['name' => 'Gino', 'email' => 'gino@gino.it', 'password' => Hash::make('12341234')],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
