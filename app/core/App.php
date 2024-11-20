<?php
class App
{
    // if we don't find the file we will use these
    private $controller = 'Home';
    private $method = 'index';
    private function splitUrl()
    {

        $URL = $_GET['url'] ?? 'home';
        $URL = explode("/", $URL);
        return $URL;
    }

    public function loadController()
    {
        $URL = $this->splitUrl();
        $fileName = "../app/controllers/" . ucfirst($URL[0]) . ".php";
        if (file_exists($fileName)) {
            require $fileName;
            $this->controller = ucfirst($URL[0]);
        } else {
            $fileName = "../app/controllers/_404.php";
            require $fileName;
            $this->controller = "_404";

        }

        // that means once we load we can instantiate and then call
        $controller = new $this->controller;
        call_user_func_array([$controller,$this->method],[]);
    }
}

