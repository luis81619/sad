<?php

 //load
 $controller = ucwords($controller);
 $controllerFile = "Controllers/".$controller.".php";
 if(file_exists($controllerFile))
 {
     require_once($controllerFile);
     $controller = new $controller();
     if(method_exists($controller, $method))
     {
         $controller->{$method}($params);
     }else{
         //echo "No existe metodo";
         require_once("Controllers/Error.php");
     }
 }else{
     //echo "No existe controlador";
     require_once("Controllers/Error.php");
 }

?>