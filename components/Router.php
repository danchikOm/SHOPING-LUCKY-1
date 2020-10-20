<?php


class Router {
    
    public $routes = [];


    public function __construct() {
        
        $routesPath = include ROOT.'/configs/router_params.php';
        $this->routes = $routesPath;
        
    }
    
    public function getUri() {
        if(!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'],'/');
        }
      }
    
    public function run() {
        
      $uri = $this->getUri();

      foreach ($this->routes as $pattern => $path){

        if(preg_match("~$pattern~", $uri)){

            $replace = preg_replace("~$pattern~", $path, $uri);

            $segments = explode('/', $replace);
            
            $controllerName = ucfirst(array_shift($segments)).'Controller';
            $controllerAction = 'action'.ucfirst(array_shift($segments));//var_dump($controllerName);
            $params = $segments;

            $controllerFile = ROOT.'/controller/'.$controllerName.'.php';

            if(file_exists($controllerFile)){

                include_once($controllerFile);

            }

            $controllerObject = new $controllerName;
            $result = call_user_func_array(array($controllerObject, "$controllerAction"),$params);
            if($result!=null){
                break;

            }
        }
          
          
      }
      
        
    }
      
}
