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
     * Getcurrent request method
     *
     * @return string
     */
    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}