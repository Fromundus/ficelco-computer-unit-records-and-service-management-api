<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // User::factory()->create([
        //     'username' => 'admin',
        //     'name' => 'Admin',
        //     'password' => Hash::make("password@123"),
        //     'role' => 'admin',
        // ]);

        User::factory()->create([
            'employeeid' => 489,
            'username' => 'jenniferdelacruz',
            'name' => 'Jennifer M. Dela Cruz',
            'password' => Hash::make("password@123"),
            'role' => 'user',
        ]);

        User::factory()->create([
            'employeeid' => 864,
            'username' => 'ralphearlcollantes',
            'name' => 'Ralph Earl L. Collantes',
            'password' => Hash::make("password@123"),
            'role' => 'user',
        ]);

        User::factory()->create([
            'employeeid' => 894,
            'username' => 'eduardstotomas',
            'name' => 'Eduard A. Sto Tomas',
            'password' => Hash::make("password@123"),
            'role' => 'user',
        ]);

        // User::factory()->create([
        //     'employeeid' => ,
        //     'username' => 'adlringuarte',
        //     'name' => 'Aldrin G. Guarte',
        //     'password' => Hash::make("password@123"),
        //     'role' => 'user',
        // ]);

        // User::factory()->create([
        //     'employeeid' => ,
        //     'username' => 'williedulay',
        //     'name' => 'Willie T. Dulay Jr.',
        //     'password' => Hash::make("password@123"),
        //     'role' => 'user',
        // ]);

        User::factory()->create([
            'employeeid' => 1390,
            'username' => 'johncarlcueva',
            'name' => 'John Carl C. Cueva',
            'password' => Hash::make("password@123"),
            'role' => 'user',
        ]);

        User::factory()->create([
            'employeeid' => 1430,
            'username' => 'billymanoguid',
            'name' => 'Billy J. Manoguid',
            'password' => Hash::make("password@123"),
            'role' => 'user',
        ]);
    }
}
