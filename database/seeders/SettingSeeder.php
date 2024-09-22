<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            [
            'name' => 'update_within',
            'value' => '3'
            ],
            [
            'name' => 'delete_within',
            'value' => '3'
            ]
        ]);
    }
}
