<?php

namespace StoreManagerPro\Src\Repository;

use PDO;
use StoreManagerPro\Src\Core\Database;

class BaseRepository
{
    protected string $tableName;
    protected PDO $db;

    public function __construct(string $tableName)
    {
        $this->tableName = $tableName;
        $this->db = Database::getInstance();
    }

    public function findAll(): array
    {
        $sql = "Select * from $this->tableName";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function findByKey(string $column, mixed $value, ?string $table = null, bool $single = false): array
    {
        $table = $table ?? $this->tableName;
        $stmt = $this->db->prepare("SELECT * FROM {$table} WHERE {$column} = ?");
        $stmt->execute([$value]);

        return $single ? $stmt->fetch(PDO::FETCH_ASSOC) : $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save(array $data): bool
    {
        $fields = implode(', ', array_keys($data));

        $placeholders = ':' . implode(', :', array_keys($data));

        $sql = "INSERT INTO {$this->tableName} ({$fields}) VALUES ({$placeholders})";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }
}
