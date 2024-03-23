<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Models\Admin;
use App\Models\User;
use Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        ///Membuat Admin
        Admin::create([
            'name' => 'admin',
            'password' => Hash::make('lol123LOL@'),
        ]);

        $faker = Faker::create();

        // Membuat 8 user laki-laki
        foreach (range(1, 8) as $index) {
            User::create([
                'name' => $faker->name,
                'email' => 'user' . $index . '@gmail.com',
                'password' => Hash::make('lol123lol'),
                'role' => 'siswa',
                'gender' => 'laki_laki',
            ]);
        }

        // Membuat 2 user perempuan
        foreach (range(1, 2) as $index) {
            User::create([
                'name' => $faker->name('female'),
                'email' => 'user' . ($index + 8) . '@gmail.com',
                'password' => Hash::make('lol123lol'),
                'role' => 'siswa',
                'gender' => 'perempuan',
            ]);
        }
    }
}
