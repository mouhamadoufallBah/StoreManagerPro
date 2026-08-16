<?php

namespace StoreManagerPro\Src\controller;

use StoreManagerPro\Src\Core\View;
use StoreManagerPro\Src\Core\SessionManager;
use StoreManagerPro\Src\Service\AuthService;

class AuthController
{
    private AuthService $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function index()
    {
        
    }

    public function login()
    {
     
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            
            $user = $this->authService->onLogin($email, $password);

            if ($user) {
                SessionManager::saveData('userConnected', $user);

                $roleId = $user['role_id'] ?? 1;

                if ($roleId == 2) {
                    header("Location: http://localhost:8000/pos");
                } elseif ($roleId == 3) {
                    header("Location: http://localhost:8000/tiers");
                } else {
                    header("Location: http://localhost:8000/");
                }
                exit;
            } else {
                View::render('auth/login', [], "auth");
            }
        }else{
               View::render('auth/login', [], "auth");
        }
    }

    public function logout()
    {
        SessionManager::removeData("userConnected");
        header("Location: http://localhost:8000/auth");
        exit;
    }
}
