<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();
        DB::table('users')->insert(array(
            0 =>
            array(
                'id' => 1,
                'role_id' => 1,
                'name' => 'Shoumen',
                'email' => 'shoumen@gmail.com',
                // 'phone' => NULL,
                // 'address' => NULL,
                // 'email_verified_at' => NULL,
                'password' => '$2y$12$3XDnFRPsCSuf8StyUiv3MOJgC/Xo7fP68aT0s6cZP4noWKW98OEhe',
                // 'two_factor_secret' => NULL,
                // 'two_factor_recovery_codes' => NULL,
                // 'two_factor_confirmed_at' => NULL,
                // 'image' => NULL,
                // 'remember_token' => NULL,
                // 'status' => 1,
                // 'last_login' => NULL,
                'created_at' => '2025-01-01 15:47:05',
                'updated_at' => '2025-01-01 15:47:05',
            ),
            // 1 =>
            // array(
            //     'id' => 2,
            //     'role_id' => 2,
            //     'name' => 'Super Admin',
            //     'email' => 'superadmin@fastit.com',
            //     'phone' => NULL,
            //     'address' => NULL,
            //     'email_verified_at' => NULL,
            //     'password' => Hash::make('fast@superadmin'),
            //     'two_factor_secret' => NULL,
            //     'two_factor_recovery_codes' => NULL,
            //     'two_factor_confirmed_at' => NULL,
            //     'image' => NULL,
            //     'remember_token' => NULL,
            //     'status' => 0,
            //     'last_login' => NULL,
            //     'created_at' => '2023-11-15 15:47:05',
            //     'updated_at' => '2023-11-15 15:47:05',
            // ),
        ));
    }
}
