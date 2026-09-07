<?php

use Modules\Core\MenuRegistry;
use Modules\Core\SettingRegistry;

if (!function_exists('setting')) {
    /**
     * Get the SettingRegistry singleton instance.
     */
    function setting(): SettingRegistry
    {
        return app(SettingRegistry::class);
    }
}

if (!function_exists('admin_menu')) {
    /**
     * Get the admin MenuRegistry singleton instance.
     */
    function admin_menu(): MenuRegistry
    {
        return app(MenuRegistry::class);
    }
}
