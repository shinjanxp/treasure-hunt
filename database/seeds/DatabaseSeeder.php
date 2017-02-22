<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        \App\User::create([
            'name' => 'Admin',
            'email' => 'admin@treasurehunt.com',
            'password' => bcrypt('password'),
            'institute' => 'Awesome Institute',
            'dob' => \Carbon\Carbon::parse('1970-01-01'),
            'is_admin' =>true,
            'activated' =>true,
        ]);
    }
}
