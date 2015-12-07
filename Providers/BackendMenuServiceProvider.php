<?php

namespace Modules\Menu\Providers;

use Illuminate\Support\ServiceProvider;
use Menu;

class BackendMenuServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function boot()
    {
        Menu::create('backend', function ($menu) {
            $menu->setPresenter('Pingpong\Menus\Presenters\Bootstrap\NavbarRightPresenter');
            $menu->route(
                'login', // route name
                trans('user::auth.login')
            );

        });
    }

    public function register()
    {
    }
}
