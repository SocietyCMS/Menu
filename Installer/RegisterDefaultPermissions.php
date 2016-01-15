<?php

namespace Modules\Menu\Installer;

class RegisterDefaultPermissions
{

    public $defaultPermissions = [

        'manage-menu' => [
            'display_name' => 'menu::module-permissions.manage-menu.display_name',
            'description'  => 'menu::module-permissions.manage-menu.description',
        ],

    ];
}