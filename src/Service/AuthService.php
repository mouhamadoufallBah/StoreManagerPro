<?php

namespace StoreManagerPro\Src\Service;

use StoreManagerPro\Src\Repository\AuthRepository;

class AuthService
{
    private AuthRepository $authRepository;

    public function __construct()
    {
        $this->authRepository = new AuthRepository();
    }

    public function onLogin(string $email, string $password): ?array
    {
        return $this->authRepository->login($email, $password);
    }
}