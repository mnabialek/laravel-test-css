<?php

namespace Mnabialek\LaravelTestCss\Providers;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;
use Mnabialek\LaravelTestCss\Middleware\LaravelTestCss as LaravelTestCssMiddleware;

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

        $this->registerMiddleware(LaravelTestCssMiddleware::class);
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

    /**
     * Register given middleware class.
     *
     * @param string $middleware
     */
    protected function registerMiddleware($middleware)
    {
        $this->app[Kernel::class]->pushMiddleware($middleware);
    }
}
