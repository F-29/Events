<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $this->seedUsers();
    }

    /**
     * Seeds the User table.
     *
     * @return void
     */
    private function seedUsers()
    {
        $count = 5;
        for($i=0; $i<$count; $i++) {
            User::create([
                'name'  => 'user' . $i,
                'email' => 'user' . $i . "@gmail.com",
                'password'  => bcrypt('13791379'),
            ]);
        }
    }
}
