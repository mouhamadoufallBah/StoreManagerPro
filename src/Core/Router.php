<?php

namespace StoreManagerPro\Src\Core;

class Router
{
    private array $routes = [];

    public function __construct()
    {
        $this->routes = [
            '/auth' => [
                'controller' => 'StoreManagerPro\Src\controller\AuthController',
                'action' => 'login'
            ],
            '/' => [
                'controller' => 'StoreManagerPro\Src\controller\DashboardController',
                'action' => 'index'
            ],
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
            '/dette' => [
                'controller' => 'StoreManagerPro\Src\controller\DetteController',
                'action' => 'index'
            ],
            '/dette/remboursement' => [
                'controller' => 'StoreManagerPro\Src\controller\DetteController',
                'action' => 'remboursement'
            ],
            '/approvisionnement' => [
                'controller' => 'StoreManagerPro\Src\controller\ApprovisionnementController',
                'action' => 'index'
            ],
            '/approvisionnement/reception' => [
                'controller' => 'StoreManagerPro\Src\controller\ApprovisionnementController',
                'action' => 'reception'
            ],
            '/tiers' => [
                'controller' => 'StoreManagerPro\Src\controller\TierController',
                'action' => 'index'
            ],
            '/tiers/addProduit' => [
                'controller' => 'StoreManagerPro\Src\controller\TierController',
                'action' => 'onAddProduit'
            ],
            '/tiers/addClient' => [
                'controller' => 'StoreManagerPro\Src\controller\TierController',
                'action' => 'onAddClient'
            ],
            '/tiers/addFournisseur' => [
                'controller' => 'StoreManagerPro\Src\controller\TierController',
                'action' => 'onAddFournisseur'
            ],
            '/logout' => [
                'controller' => 'StoreManagerPro\Src\controller\AuthController',
                'action' => 'logout'
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

        if ($uri != "/auth" && !SessionManager::isConnected()) {
            header("Location: http://localhost:8000/auth");
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
