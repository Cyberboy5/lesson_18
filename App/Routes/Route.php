<?php
namespace App\Routes;

error_reporting(E_ALL);
ini_set('display_errors', 1);


class Route{


    public $request;
    public static array $routes = [];

    public function __construct(Request $requests){
        $this->request = $requests;
    }

    public static function get($path, $action){
        self::$routes['get'][$path] = $action;
    }

    public static function post($path, $action){
        self::$routes['post'][$path] = $action;
    }
    
    public function action(){
        $path = $this->request->url();
        $method = $this->request->method();
        $action = self::$routes[$method][$path] ?? false;

        // var_dump(!$action);
        // dd(self::$routes);
        // dd($path,$method,$action);

        if(!$action){
            echo "404 Not Found:" . $path; 
        }
        
        if(is_array($action)){
            $controller = new $action[0]();
            $controller->{$action[1]}();
        }
    }
    }



?>