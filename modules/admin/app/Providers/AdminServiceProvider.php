<?php

namespace Modules\Admin\Providers;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\App;
use Modules\Core\MenuBuilder;
use Modules\Core\MenuRegistry;
use Nwidart\Modules\Support\ModuleServiceProvider;

class AdminServiceProvider extends ModuleServiceProvider
{
    /**
     * The name of the module.
     */
    protected string $name = 'Admin';

    /**
     * The lowercase version of the module name.
     */
    protected string $nameLower = 'admin';

    /**
     * Command classes to register.
     *
     * @var string[]
     */
    // protected array $commands = [];

    /**
     * Provider classes to register.
     *
     * @var string[]
     */
    protected array $providers = [
        EventServiceProvider::class,
        RouteServiceProvider::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        parent::register();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        parent::boot();

        $this->loadTranslations();
        $this->registerDefaultMenu();
    }

    /**
     * Register the default admin sidebar menu.
     */
    protected function registerDefaultMenu(): void
    {
        $registry = App::make(MenuRegistry::class);

        $registry->register('admin.sidebar.overview', function (MenuBuilder $menu) {
            $menu->add('admin.sidebar.dashboard', 'dashboard', 'admin.dashboard');
        });

        $registry->register('admin.sidebar.management', function (MenuBuilder $menu) {
            $menu->add('admin.sidebar.contacts', 'contact', '#');
            $menu->add('admin.sidebar.users', 'users', '#');
        });

        $registry->register('admin.sidebar.system', function (MenuBuilder $menu) {
            $menu->add('admin.sidebar.settings', 'settings', 'admin.settings.index', 'admin.settings*');
        });
    }

    /**
     * Load module translations.
     */
    protected function loadTranslations(): void
    {
        $langPath = module_path($this->name, '/resources/lang');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath);
        }
    }

    /**
     * Define module schedules.
     *
     * @param  $schedule
     */
    // protected function configureSchedules(Schedule $schedule): void
    // {
    //     $schedule->command('inspire')->hourly();
    // }
}
