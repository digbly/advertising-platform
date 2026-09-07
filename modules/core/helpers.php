<?php

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
