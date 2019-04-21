<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            [
                'nama_role'  => 'Admin'
            ],
            [
                'nama_role'  => 'User'
            ]
        ]);
    }
}
