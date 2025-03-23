<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'admin@local.test',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);
    }
}
