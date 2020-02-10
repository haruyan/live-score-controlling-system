<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
        [
            'fullname' => 'Admin Admin',
            'username' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ],[
            'fullname' => 'Second Admin',
            'username' => 'dummin',
            'email' => 'second@admin.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]
        ]);
        
        $faker = \Faker\Factory::create('id_ID');
        $jml_wasit = 10;
        for ($i = 1; $i <= $jml_wasit; $i++) {
            $wasit = new User();
            $wasit->fullname = $faker->name;
            $wasit->username = $faker->userName;
            $wasit->email = $faker->email;
            $wasit->password = bcrypt('password');
            $wasit->role = 'arbitre';
            $wasit->save();
        }
    }
}
