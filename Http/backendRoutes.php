<?php

$router->group(['prefix' => '/menu'], function ($router) {
    // Menu
    $router->group(['middleware' => ['permission:menu::manage-menu']], function () {
        get('menu', ['as' => 'backend::menu.menu.index', 'uses' => 'MenuController@index']);
    });
});
