<?php

use Illuminate\Database\Seeder;
use App\Models\User;

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
                'password'   => app('hash')->make('masuk123'),
                'email'      => 'admin@admin.com',
                'nama'       => 'Administrator',
                'role'       => 1
            ],
            [
                'password'   => app('hash')->make('masuk123'),
                'email'      => 'gen781@gmail.com',
                'nama'       => 'Rahmat Ade Saputra',
                'role'       => 2
            ]
        ]);
    }
}
