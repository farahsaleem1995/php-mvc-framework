<?php


namespace App\Core;


class Request
{
    /**
     * Get current request url.
     *
     * @return string
     */
    public function getPath(): string
    {
        $path = $_SERVER['REQUEST_URI'];
        $qstnPos = strpos($path, '?') ?? '/';

        return $qstnPos ? substr($path, 0, $qstnPos) : $path;
    }

    /**
     * Get current request method
     *
     * @return string
     */
    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * @return array
     */
    public function body(): array
    {
        if ($this->getMethod() === 'get') {
            return $this->handleGetRequest();
        } elseif ($this->getMethod() === 'post') {
            return $this->handlePostRequest();
        }
    }

    protected function handleGetRequest()
    {
        $body = [];

        foreach ($_GET as $key => $value) {
            $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        return $body;
    }

    protected function handlePostRequest()
    {
        $body = [];

        foreach ($_POST as $key => $value) {
            $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        return $body;
    }
}