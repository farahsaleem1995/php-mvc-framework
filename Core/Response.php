<?php


namespace App\Core;


use Exception;

class Response
{
    public function setStatusCode($code): void
    {
        http_response_code(404);
    }

    /**
     * @param string $filename
     * @param array $data
     * @return string
     */
    public function render(string $filename, array $data = []): string
    {
        $view = $this->renderView($filename, $data);

        if (!$view) {
            return $this->render('_404');
        }

        $extends = [];
        $hasLayout = preg_match('#@extends\("(.*?)"\)#', $view, $extends);
        $layoutFilename = str_replace('@extends("', '', $extends[0]);
        $layoutFilename = str_replace('")', '', $layoutFilename);

        $layout = $hasLayout ? $this->renderLayout($layoutFilename) : false;

        if (!$layout) {
            return $this->render('_404');
        }

        $view = str_replace('@extends("' . $layoutFilename . '")', '', $view);

        return str_replace('@content', $view, $layout);
    }

    /**
     * @param string $content
     * @return false|string
     */
    public function content(string $content)
    {
        $layout = $this->renderLayout();

        return str_replace('@content', $content, $layout);
    }

    /**
     * @param string $filename
     * @return false|string
     * @throws Exception
     */
    protected function renderLayout(string $filename)
    {
        $path = $this->getViewPath("Layouts.$filename");

        if (!file_exists($path)) {
            throw new Exception("File Layouts/$filename.php not found");
        }

        ob_start();

        include_once $path;

        return ob_get_clean();
    }

    /**
     * @param string $filename
     * @param array $data
     * @return false|string
     * @throws Exception
     */
    protected function renderView(string $filename, array $data)
    {
        $path = $this->getViewPath("$filename");

        if (!file_exists($path)) {
            throw new Exception("File $filename.php not found");
        }

        foreach ($data as $key => $value) {
            $$key = $value;
        }

        ob_start();

        include_once $this->getViewPath($filename);

        return ob_get_clean();
    }

    /**
     * @param string $filename
     * @return string
     */
    private function getViewPath(string $filename): string
    {
        $filePath = explode('.', $filename);

        return implode('/', array_merge([Application::$rootPath, 'Views'], $filePath)) . '.php';
    }
}