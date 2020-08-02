<?php

use Illuminate\Database\Seeder;
use App\User;

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
            'name' => 'Martin Sinka',
            'email' => 'martin@gmail.com',
            'password' => bcrypt('12345678'),
            'remember_token' => Str::random(10),
            'dni' => '8400954',
            'address' => '',
            'phone' => '',
            'role' => 'admin'
        ]);
        factory(User::class, 50)->create();
    }
}
