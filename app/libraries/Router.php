<?php

class Router {
    private $current_controller = 'HomeController';
    private $current_method = 'index';
    private $param = 0;

    public function __construct() {
        $url = $this -> get_url();

        if (isset($url[0])) {
            if (file_exists('../app/controllers/' . $url[0] . 'Controller.php')) {
                $this -> current_controller = $url[0] . 'Controller';
            }
        }

        require '../app/controllers/' . $this -> current_controller . '.php';
    
        $controller = new $this -> current_controller();

        if (isset($url[1])) {
            if (method_exists($controller, $url[1])) {
                $this -> current_method = $url[1];
            }
        }

        if (isset($url[2])) {
            $this -> param = $url[2];
        }
        
        $method = $this -> current_method;

        $controller->$method($this -> param);
    }

    public function get_url() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = explode('/', $url);
            return $url;
        }
    }


}