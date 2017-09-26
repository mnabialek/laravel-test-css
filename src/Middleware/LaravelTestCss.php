<?php

namespace Mnabialek\LaravelTestCss\Middleware;

use Closure;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Http\Response;

class LaravelTestCss
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * LaravelTestCss constructor.
     *
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        /** @var Response $response */
        $response = $next($request);
        if ($response instanceof Response && app()->runningUnitTests() &&
            str_contains($response->headers->get('Content-Type'), 'text/html')) {
            $content = $response->getContent();
            if (($head = mb_strpos($content, '</head>')) !== false) {
                $response->setContent(mb_substr($content, 0, $head) .
                    '<style>' . $this->config->get('laravel_test_css.style') . '</style>' .
                    mb_substr($content, $head));
            }
        }

        return $response;
    }
}
