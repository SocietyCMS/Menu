<?php

$api->version('v1', function ($api) {
    $api->group([
        'prefix' => 'menu',
        'namespace' => $this->namespace . '\api',
        'middleware' => config('society.core.core.middleware.api.backend', []),
        'providers' => ['jwt']
    ], function ($api) {

        $api->resource('menu', 'MenuController', ['only' => ['store']]);
    });
});
