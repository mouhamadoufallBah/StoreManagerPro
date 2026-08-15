<?php

namespace StoreManagerPro\Src\Core;

class SessionManager
{
    private static ?SessionManager $instance = null;

    private function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function getInstance(): SessionManager
    {
        if (self::$instance === null) {
            self::$instance = new SessionManager();
        }
        return self::$instance;
    }

    public function getData(string $key): mixed
    {
        return $_SESSION[$key] ?? null;
    }

    public function saveData(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function hasKey(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    public function removeData(string $key): void
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
}
