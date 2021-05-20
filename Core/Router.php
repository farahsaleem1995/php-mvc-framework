<?php

namespace App\Core;

use Closure;
use Exception;
use ReflectionFunction;

/**
 * Class Router
 *
 * @package App\Router
 */
class Router
{
    /**
     * @var array
     */
    protected array $routes = [];

    /**
     * @var Request
     */
    protected Request $request;

    /**
     * Router constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param string $path
     * @param Closure $callbak
     */
    public function get(string $path, Closure$callbak)
    {
        $this->routes['get'][$path] = $callbak;
    }

    /**
     * @return void
     * @throws Exception
     */
    public function resolve(): void
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        if (!$callback) {
            echo 'Not Found';
            exit();
        }

        try {
            $callbackReflection = new ReflectionFunction($callback);
            $callbackReflection->invoke();
        } catch (Exception $exception) {
            throw new Exception('Failed to execute function');
        }
    }
}