<?php

namespace Modules\Menu\Database\Seeders;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Menu\Entities\Menu;

class DemoTableSeeder extends Seeder
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
            'name'            => 'SocietyCMS',
            'url'             => '',
            'active'          => true,
            'attribute_class' => 'nav-header',
        ]);

        // Auth
        $auth = Menu::create(['name' => 'Auth']);
        $auth->children()->create(['name' => 'Login', 'url' => 'auth/login', 'active' => true]);
    }
}
