<?php
class App
{
    // if we don't find the file we will use these
    private $controller = 'Home';
    private $method = 'index';
    private function splitUrl()
    {

        $URL = $_GET['url'] ?? 'home';
        $URL = explode("/", trim($URL, '/'));
        return $URL;
    }

    public function loadController()
    {
        $URL = $this->splitUrl();
        /** Select the controller */
        $fileName = "../app/controllers/" . ucfirst($URL[0]) . ".php";
        if (file_exists($fileName)) {
            require $fileName;
            $this->controller = ucfirst($URL[0]);
            unset($URL[0]);
        } else {
            $fileName = "../app/controllers/_404.php";
            require $fileName;
            $this->controller = "_404";
        }
        
        // that means once we load we can instantiate and then call
        $controller = new $this->controller;
        /** Select method */
        if (!empty($URL[1])) {
            if (method_exists($controller, $URL[1])) {
                $this->method = $URL[1];
                unset($URL[1]);
            }
        }
        //show($URL);
        call_user_func_array([$controller, $this->method], $URL);
    }
}
