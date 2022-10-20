<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Wakil Kepala Sekolah',
            'username' => 'wakasek',
            'password' => bcrypt('12345'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Kepala Sekolah',
            'username' => 'kepsek',
            'password' => bcrypt('12345'),
            'role' => 'user'
        ]);
    }
}
