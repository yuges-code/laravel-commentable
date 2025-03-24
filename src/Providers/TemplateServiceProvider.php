<?php

namespace Vendor\Template\Providers;

use TypeError;
use Vendor\Template\Config\Config;
use Vendor\Template\Models\Template;
use Illuminate\Support\ServiceProvider;
use Vendor\Template\Observers\TemplateObserver;

class TemplateServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $class = Config::getTemplateClass();

        if (! is_a(new $class, Template::class)) {
            throw new TypeError('Invalid model');
        }

        $class::observe(new TemplateObserver);

        $this->publishes([
            __DIR__.'/../../config/template.php' => config_path('template.php')
        ], 'template-config');

        $this->publishes([
            __DIR__.'/../../database/migrations/' => database_path('migrations')
        ], 'template-migrations');

        $this->publishes([
            __DIR__.'/../../database/seeders/' => database_path('seeders')
        ], 'template-seeders');
    }
}
