<?php
 class App{
     private $controller = 'Dashboard';
     private $method = 'index';
     private $params = [];
     public function __construct()
     {
        $url = $this->parseURL();
        if (file_exists ('../app/controllers/' . $url[0] . '.php')){
            $this->controller = $url[0];
            unset($url[0]);
        }

        require_once '../app/controllers/' . $this->controller . '.php';

         $this->controller = new $this->controller;


         if (isset($url[1])){
            $this->method = $url[1];
            unset($url[1]);
         }

         if (!empty($params)){
             $this->params = array_values($url);
         }

         call_user_func_array([$this->controller, $this->method], $this->params);
     }

     public function parseURL()
     {
         if (isset($_GET['url'])){
            $url = rtrim($_GET['url'] , '/');
            $url = filter_var($url , FILTER_SANITIZE_URL);
            $url = explode('/' , $url);

            return $url;
         } else {
             return [$this->controller];
         }
     }
 }