<?php

$router->group(['prefix' => '/menu'], function () {
    get('menu', ['as' => 'backend::menu.menu.index', 'uses' => 'MenuController@index']);
});
