<?php

namespace App\Core;

/**
 * Class Application
 *
 * @package App\Core
 */
class Application
{
    public static string $rootPath;
    public Router $router;
    public Request $request;
    public Response $response;

    /**
     * Application constructor.
     *
     * @param string $rootPath
     */
    public function __construct(string $rootPath)
    {
        self::$rootPath = $rootPath;

        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
    }

    public function run()
    {
        echo $this->router->resolve();
    }
}