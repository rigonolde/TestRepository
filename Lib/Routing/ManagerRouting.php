<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Lib\Routing;

use Controller\CategoryController;

/**
 * Description of ManagerRouting
 *
 * @author josio
 */
class ManagerRouting
{

    public function __construct()
    {
        $this->requireAllController();
    }

    public function getRoutes($url)
    {

        $xml = new \DOMDocument;
        $xml->load($_SERVER['DOCUMENT_ROOT'] . '/Controller/Routing/routing.xml');
        $routes = $xml->getElementsByTagName('route');
        $this->findRoute($routes, $url);
    }

    private function findRoute($routes, $url)
    {
        if ($url == "/") {
            $arrayUrl = explode("/", $url);
            foreach ($routes as $value) {
                $path = $value->getAttribute('urlPath');
                $controller = $value->getAttribute('controller');
                $action = $value->getAttribute('action');
                if ($path == "/") {
                    $arrayPath = explode("/", trim(($path), "/"));
                    $routeParams = $this->getRouteParameters($arrayPath, $arrayUrl);
                    $class = new $controller();
                    call_user_func(array($class, $action), $routeParams);
                }
            }
        } else {
            $url = trim($url, "/");
            $arrayUrl = explode("/", $url);
            foreach ($routes as $value) {
                $path = $value->getAttribute('urlPath');
                $controller = $value->getAttribute('controller');
                $action = $value->getAttribute('action');
                $arrayPath = explode("/", trim(($path), "/"));

                if (count($arrayUrl) == count($arrayPath)) {
                    if ($this->compareRoute($arrayPath, $arrayUrl) == true) {
                        $routeParams = $this->getRouteParameters($arrayPath, $arrayUrl);
                        $class = new $controller();
                        call_user_func(array($class, $action), $routeParams);
                    }
                }
            }
        }
    }

    private function compareRoute($arrayPath, $arrayUrl)
    {
        foreach ($arrayPath as $key => $value) {
            if (strpos($value, "{") == false && strpos($value, "}") == false) {
                if ($value != $arrayUrl[$key]) {
                    return false;
                }
            } else {
                continue;
            }
        }
        return true;
    }

    private function getRouteParameters($arrayPath, $arrayUrl)
    {
        $parameters = array();
        foreach ($arrayPath as $key => $value) {
            if (strpos($value, "{") == false && strpos($value, "}") == false) {
                continue;
            } else {
                $parameters[] = $arrayUrl[$key];
            }
        }
        return $parameters;
    }

    function requireAllController()
    {
        $directory = new \RecursiveDirectoryIterator($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR);
        $recIterator = new \RecursiveIteratorIterator($directory);
        $regex = new \RegexIterator($recIterator, '/^.+\Controller.php$/i');
        foreach ($regex as $item) {
            include $item->getPathname();
        }
    }

}
