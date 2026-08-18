<?php

namespace StoreManagerPro\Src\Core;

use PDO;
use PDOException;
use PDOStatement;

class Database
{
    private static ?PDO $instance = null;

    public static function getInstance(): PDO
    {
        if (self::$instance == null) {
            try {
                $dsn = "pgsql:host=localhost;dbname=store_manager_pro";
                self::$instance = new PDO($dsn, "postgres", "postgres");
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                error_log("Connexion PostgreSQL échouée : " . $e->getMessage());

                $dbPath = BASEPATH . "/doc/erp.db";
                self::$instance = new PDO("sqlite:" . $dbPath);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        }
        return self::$instance;
    }

    public static function query(string $sql, bool $single = true): mixed
    {
        $query = self::$instance->query($sql);
        return $single ? $query->fetch() : $query->fetchAll(PDO::FETCH_ASSOC);
    }

    private static function prepare(string $sql, array $datas): PDOStatement
    {
        $prepare = self::$instance->prepare($sql);
        $prepare->execute($datas);
        return $prepare;
    }

    public static function executeQuery(string $sql, array $datas, bool $single = true): mixed
    {
        $statement = self::prepare($sql, $datas);
        return $single ? $statement->fetch() : $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function executeUpdate(string $sql, array $datas): int|string
    {
        $statement = self::prepare($sql, $datas);
        return (str_starts_with(strtoupper(trim($sql)), 'INSERT')) ? self::$instance->lastInsertId() : $statement->rowCount();
    }

    public static function getAllData(string $tableName): array
    {
        $sql = "SELECT * FROM $tableName";
        return self::query($sql, false);
    }
}
