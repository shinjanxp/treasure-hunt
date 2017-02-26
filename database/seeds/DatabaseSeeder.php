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
            'name' => env('ADMIN_NAME','Admin'),
            'email' => env('ADMIN_EMAIL','admin@treasurehunt.com'),
            'password' => bcrypt(env('ADMIN_PASSWORD','password')),
            'institute' => env('ADMIN_INSTITUTE','Awesome Institute'),
            'dob' => \Carbon\Carbon::parse(env('ADMIN_DOB','1970-01-01')),
            'is_admin' =>true,
            'activated' =>true,
        ]);
    }
}
