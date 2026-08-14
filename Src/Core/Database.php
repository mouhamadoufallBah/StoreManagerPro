<?php

namespace Src\Core;

use PDO;
use PDOException;

class Database {
    private static ?PDO $instance = null;

    public static function getInstance(): PDO {
        if (self::$instance === null) {
            try {
                $dsn = "pgsql:host=localhost;dbname=Store_manager_pro";
                self::$instance = new PDO($dsn, "postgres", "postgres");
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
            } catch (PDOException $e) {
                error_log("Connexion PostgreSQL échouée : " . $e->getMessage());
                
               $dbPath = BASEPATH . "/Doc/erp.db";
// var_dump($dbPath);
                self::$instance = new PDO("sqlite:" . $dbPath);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        }
        return self::$instance;
    }
}