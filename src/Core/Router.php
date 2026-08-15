<?php

namespace StoreManagerPro\Src\Core;

class Router
{
    private array $routes = [];

    public function __construct()
    {
        $this->routes = [
            '/pos' => [
                'controller' => 'StoreManagerPro\Src\controller\PosController',
                'action' => 'index'
            ],
            '/pos/addToCart' => [
                'controller' => 'StoreManagerPro\Src\controller\PosController',
                'action' => 'addToCart'
            ],
            '/pos/removeToCart' => [
                'controller' => 'StoreManagerPro\Src\controller\PosController',
                'action' => 'removeToCart'
            ],
            '/pos/addVente' => [
                'controller' => 'StoreManagerPro\Src\controller\PosController',
                'action' => 'addVente'
            ],

        ];
    }

    public function redirection(): void
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        if (!isset($this->routes[$uri])) {
            http_response_code(404);
            echo "Page introuvable";
            exit;
        }

        $controllerClass = $this->routes[$uri]['controller'];
        $action = $this->routes[$uri]['action'];

        if (class_exists($controllerClass)) {

            $controllerInstance = new $controllerClass();

            if (method_exists($controllerInstance, $action)) {
                $controllerInstance->$action();
            } else {
                http_response_code(500);
                echo "Erreur : La méthode '$action' est introuvable.";
            }
        } else {
            http_response_code(404);
            echo "Erreur : Le contrôleur '$controllerClass' est introuvable.";
        }
    }
}
