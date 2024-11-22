<?php
// A Controller class that is going to have basic functionality of loading views
trait Controller
{
    public function view($name)
    {
        $fileName = "../app/views/" . $name . ".view.php";
        if (file_exists($fileName)) {
            require $fileName;
        } else {
            $fileName = "../app/views/404.view.php";
            require $fileName;
        }
    }
}
