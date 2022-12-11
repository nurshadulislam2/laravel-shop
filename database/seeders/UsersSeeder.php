<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      =>'admin',
            'email'     =>'admin@gmail.com',
            'password'  =>Hash::make('admin'),
            'mobile'    =>'01677',
            'address'   =>'Dhaka',
            'is_admin'  =>1
        ]);
    }
}
