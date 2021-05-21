<?php

namespace App\Core;

use Closure;
use Exception;
use ReflectionClass;
use ReflectionException;
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
     * @var Response
     */
    protected Response $response;

    /**
     * Router constructor.
     *
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @param string $path
     * @param Closure|array|string $callback
     */
    public function get(string $path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    /**
     * @param string $path
     * @param Closure|array|string $callback
     */
    public function post(string $path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        if (!$callback) {
            $this->response->setStatusCode(404);
            return $this->response->render('_404');
        }

        if (is_string($callback)) {
            return $this->response->render($callback);
        }

        if (is_array($callback)) {
            try {
                $callbackClassReflection = new ReflectionClass($callback[0]);
                $instance = $callbackClassReflection->newInstance();

                return $callbackClassReflection->getMethod($callback[1])->invokeArgs($instance, [$this->request, $this->response]);
            } catch (ReflectionException $exception) {
                throw new Exception('Failed to execute function');
            }
        }

        try {
            $callbackReflection = new ReflectionFunction($callback);
        } catch (ReflectionException $exception) {
            throw new Exception('Failed to execute function');
        }

        return $callbackReflection->invoke();
    }
}