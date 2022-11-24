<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'Admin User',
            'email' => 'alemagarishor121@gmail.com',
            'password' =>'123456',
            'phone' => '9849980201',
            'address' => 'KTM',
            'type' => 'Admin',
            'status' => 'Active',
        ]);
    }
}
