<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::firstOrCreate([
            'email' => 'triangle@admin.com',
            'name' => 'Triangle Admin',
            'password' => bcrypt('$trianglepass$'),
            'is_admin' => 1
        ]);
    }
}
