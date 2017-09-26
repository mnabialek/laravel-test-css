<?php

namespace Mnabialek\LaravelTestCss\Providers;

use Illuminate\Support\ServiceProvider;

class LaravelTestCss extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../publish/config/laravel_test_css.php',
            'laravel_test_css');

        // register files to be published
        $this->publishes($this->getFilesToPublish());
    }

    /**
     * Get files that will be published.
     *
     * @return array
     */
    protected function getFilesToPublish()
    {
        return [
            __DIR__ . '/../../publish/config/laravel_test_css.php' => config_path('laravel_test_css.php'),
        ];
    }
}
