<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = new AdminUser();
        $user->name = 'Admin';
        $user->email = 'admin@nomail.com';
        $user->password = Hash::make('admin@123');
        $user->save();
    }
}
