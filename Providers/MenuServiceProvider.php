<?php

namespace Modules\Menu\Providers;

use App;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;
use Modules\Menu\Repositories\Menu\MenuBuilder;
use Pingpong\Modules\Contracts\RepositoryInterface;

/**
 * Class MenuServiceProvider.
 *
 * @property RepositoryInterface modules
 * @property Container container
 */
class MenuServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @param RepositoryInterface $modules
     * @param Container           $container
     */
    public function boot(RepositoryInterface $modules, Container $container)
    {
        $this->modules = $modules;
        $this->container = $container;

        App::booted(function ($app) {
            $this->defineMenuBuilder();
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Define de MenuBuilder.
     */
    private function defineMenuBuilder()
    {
        if (! $this->app['society.isInstalled']) {
            return;
        }

        return app(MenuBuilder::class)->buildMenus();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
