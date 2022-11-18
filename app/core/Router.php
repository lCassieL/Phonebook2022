<?php
class Router {
    static function init() {
        $controller_name = 'main';
        $action_name = 'index';
        $routes = explode('/', $_SERVER['REQUEST_URI']);
        if(!empty($routes[1])) {
            $controller_name = strtolower($routes[1]);
        }
        if(!empty($routes[2])) {
            $action_name = strtolower($routes[2]);
        }

        $controller_name = ucfirst($controller_name);
        $controller_class = $controller_name.'Controller';
        $model_class = $controller_name.'Model';
        $action = 'action_'.$action_name;
        $model_path = 'app/models/'.$model_class.'.php';
        if(file_exists($model_path)) {
            include $model_path;
        }
        $controller_path = 'app/controllers/'.$controller_class.'.php';
        if(file_exists($controller_path)) {
            include $controller_path;
        } else {
            self::ErrorPage404();
            return;
        }
        if(!isset($_SESSION['login'])) {
            $_SESSION['login'] = false;
        }
        if(!isset($_SESSION['message'])) {
            $_SESSION['message'] = false;
        } else {
            $_SESSION['message'] = false;
        }
        /*if($controller_class != 'UserController' && !$_SESSION['login'] && $action !='action_index'){
            $_SESSION['message'] = "you are not authorized";
            GenerateHeader::generateHeader(false, 401, $_SESSION['message']);
            return;
        }*/
        $controller = new $controller_class;
        if(method_exists($controller, $action)) {
            empty($routes[3]) ? $controller->$action() : $controller->$action($routes[3]);
        } else {
            self::ErrorPage404();
        }
    }

    static function ErrorPage404() {
        //$_SESSION['message'] = "Page doesn't exist";
        GenerateHeader::generateHeader(false, 404, $_SESSION['message']);
    }
}