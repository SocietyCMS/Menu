<?php

namespace Modules\Menu\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use DB;
use Modules\Menu\Entities\Menu;

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

        DB::table('menu__menus')->delete();

        $main = Menu::create(['name' => 'Main']);

        $main->children()->create(['name' => 'Blog']);
        $main->children()->create(['name' => 'Gallery']);
        $main->children()->create(['name' => 'Pages']);
        $main->children()->create(['name' => 'Recent']);


        $social = Menu::create(['name' => 'Social']);

        $social->children()->create(['name' => 'Facebook']);
        $social->children()->create(['name' => 'Twitter']);
        $social->children()->create(['name' => 'Youtube']);

        $footer = Menu::create(['name' => 'Footer']);

        $footer->children()->create(['name' => 'Github']);
        $footer->children()->create(['name' => 'About As']);
        $footer->children()->create(['name' => 'Contact']);

    }
}
