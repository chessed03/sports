<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([
            'user_id'     => '1',
            'permissions' => '[{"read": [], "write": ["1"], "module_id": "2"}]',
            'created_by'  => '1-Root',
        ]);
    }
}
