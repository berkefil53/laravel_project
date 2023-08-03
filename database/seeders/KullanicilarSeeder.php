<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KullanicilarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [[
                'username'=>'berkefil53',
                'user_title'=>'batırhan berk',
                'password'=>Hash::make('ERWERWE')
            ],
                [
                    'username'=>'admin',
                    'user_title'=>'admin',
                    'password'=>Hash::make('admin155')
                ]]

        );
    }
}
