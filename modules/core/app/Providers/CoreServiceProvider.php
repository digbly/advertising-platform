<?php

namespace Modules\Core\Providers;

use Illuminate\Support\Facades\App;
use Modules\Core\MenuRegistry;
use Modules\Core\SettingRegistry;
use Nwidart\Modules\Support\ModuleServiceProvider;

class CoreServiceProvider extends ModuleServiceProvider
{
    /**
     * The name of the module.
     */
    protected string $name = 'Core';

    /**
     * The lowercase version of the module name.
     */
    protected string $nameLower = 'core';

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

        App::singleton(SettingRegistry::class, function () {
            return new SettingRegistry;
        });

        App::singleton(MenuRegistry::class, function () {
            return new MenuRegistry;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadTranslations();
        $this->registerDefaultSettings();
    }

    /**
     * Load module translations.
     */
    protected function loadTranslations(): void
    {
        $this->loadTranslationsFrom(module_path($this->name, '/resources/lang'));
    }

    /**
     * Register default settings.
     */
    protected function registerDefaultSettings(): void
    {
        $registry = App::make(SettingRegistry::class);

        $registry->register('site_title', function ($builder) {
            $builder->label('Site Title')
                ->rules(['required', 'string', 'max:255'])
                ->default('My Site')
                ->description('The title of the website.')
                ->group('general');
        });

        $registry->register('site_name', function ($builder) {
            $builder->label('Site Name')
                ->rules(['required', 'string', 'max:255'])
                ->default('My Site')
                ->description('The display name of the website.')
                ->group('general');
        });

        $registry->register('site_description', function ($builder) {
            $builder->label('Site Description')
                ->rules(['nullable', 'string', 'max:500'])
                ->default(null)
                ->description('A short description of the website.')
                ->group('general');
        });
    }
}
