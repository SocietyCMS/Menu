<?php

namespace Modules\Menu\Providers;

use App;
use Cache;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;
use Modules\Menu\Repositories\Menu\MenuBuilder;
use Pingpong\Modules\Contracts\RepositoryInterface;

/**
 * Class MenuServiceProvider.
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
     * @param Container $container
     */
    public function boot(RepositoryInterface $modules, Container $container)
    {
        $this->modules = $modules;
        $this->container = $container;

        $this->registerConfig();
        $this->registerTranslations();
        $this->registerViews();

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
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . '/../Config/config.php' => config_path('menu.php'),
        ]);
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/config.php', 'menu'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/modules/menu');

        $sourcePath = __DIR__ . '/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath,
        ]);

        $this->loadViewsFrom([$viewPath, $sourcePath], 'menu');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = base_path('resources/lang/modules/menu');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'menu');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'menu');
        }
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
