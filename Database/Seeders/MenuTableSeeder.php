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


        // Main
        $main = Menu::create(['name' => 'Main']);

        $main->children()->create([
            'name' => 'SocietyCMS',
            'url' => '',
            'active' => true,
            'attribute_class' => 'nav-header'
        ]);
        $main->children()->create(['name' => 'Blog', 'url' => 'blog', 'active' => true]);
        $main->children()->create(['name' => 'Gallery', 'url' => 'gallery', 'active' => true]);


        // Social
        $social = Menu::create(['name' => 'Social']);

        $social->children()->create(['name' => 'Facebook']);
        $social->children()->create(['name' => 'Twitter']);
        $social->children()->create(['name' => 'Youtube']);


        // Footer
        $footer = Menu::create(['name' => 'Footer']);

        $footer->children()->create(['name' => 'Github', 'url' => 'https://github.com/SocietyCMS/SocietyCMS', 'active' => true]);
        $footer->children()->create(['name' => 'About As', 'url' => 'blog', 'active' => true]);
        $footer->children()->create(['name' => 'Contact', 'url' => 'blog2', 'active' => true]);


        // Auth
        $auth = Menu::create(['name' => 'Auth']);

        $auth->children()->create(['name' => 'Login', 'url' => 'auth/login', 'active' => true]);


    }
}
