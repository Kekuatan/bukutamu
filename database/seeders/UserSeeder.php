<?php

namespace Database\Seeders;

use App\Enum\UserEnum;
use App\Models\Shift;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create
        (
            ['name' => 'admin test',
            'password' => Hash::make('admin'),
            'email' => 'admin@admin.com',
        ]);//Hash::make($request->password),
    }
}
