<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('modules')->insert([
            'module_id'  => '',
            'position'   => '1',
            'name'       => 'Publicación',
            'route'      => '#',
            'icon'       => 'bx bx-fw bxl-digitalocean',
            'level'      => '0',
            'created_by' => '1-Root',
        ]);

        DB::table('modules')->insert([
            'module_id'  => '1',
            'position'   => '2',
            'name'       => 'Posts',
            'route'      => 'post-index',
            'icon'       => 'bx bx-fw bx-toggle-left',
            'level'      => '1',
            'created_by' => '1-Root',
        ]);

        DB::table('modules')->insert([
            'module_id'  => '1',
            'position'   => '3',
            'name'       => 'Videos',
            'route'      => 'video-index',
            'icon'       => 'bx bx-fw bx-toggle-left',
            'level'      => '1',
            'created_by' => '1-Root',
        ]);

        DB::table('modules')->insert([
            'module_id'  => '1',
            'position'   => '4',
            'name'       => 'Carrusel de imágenes',
            'route'      => 'carousel-image-index',
            'icon'       => 'bx bx-fw bx-toggle-left',
            'level'      => '1',
            'created_by' => '1-Root',
        ]);

    }
}
