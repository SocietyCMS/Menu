<?php

namespace Modules\Menu\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use DB;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $mainMenu = DB::table('menu__menus')->insert([
            'title' => 'Main',
        ]);

        $footerMenu = DB::table('menu__menus')->insert([
            'title' => 'Footer',
        ]);

        $socialMenu = DB::table('menu__menus')->insert([
            'title' => 'Social',
        ]);

    }
}
