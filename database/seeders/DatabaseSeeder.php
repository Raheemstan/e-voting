<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Admin::factory(1)->create();
        
        DB::table('admins')->insert([
            'username' => "inec",
            'password' => Hash::make('Inec_Chairman'),
        ]);
        DB::table('admins')->insert([
            'username' => "admin",
            'password' => Hash::make('Admin@NACOS'),
        ]);

        DB::table('positions')->insert([
            'positions' => "President"
        ]);
        DB::table('positions')->insert([
            'positions' => "Vice President"
        ]);
        DB::table('positions')->insert([
            'positions' => "Secretary General"
        ]);
        DB::table('positions')->insert([
            'positions' => "Assistant Secretary General"
        ]);
        DB::table('positions')->insert([
            'positions' => "Auditor General"
        ]);
        DB::table('positions')->insert([
            'positions' => "Treasurer"
        ]);
        DB::table('positions')->insert([
            'positions' => "Financial Secretary"
        ]);
        DB::table('positions')->insert([
            'positions' => "Director of Academics I"
        ]);
        DB::table('positions')->insert([
            'positions' => "Director of Academics II"
        ]);
        DB::table('positions')->insert([
            'positions' => "Director of Welfare"
        ]);
        DB::table('positions')->insert([
            'positions' => "Director of Software"
        ]);
        DB::table('positions')->insert([
            'positions' => "Director of Social"
        ]);
        DB::table('positions')->insert([
            'positions' => "Director of Sports"
        ]);
        DB::table('positions')->insert([
            'positions' => "Provost"
        ]);
        DB::table('positions')->insert([
            'positions' => "P.R.O"
        ]);
    }
}
