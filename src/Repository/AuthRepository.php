<?php

namespace StoreManagerPro\Src\Repository;

use PDO;

class AuthRepository extends BaseRepository
{

    public function __construct()
    {
        return parent::__construct('utilisateur');
    }

    public function login(string $email, string $password): ?array
    {
        $sql = "SELECT u.*, r.libelle
                FROM utilisateur u
                LEFT JOIN role r ON r.id = u.role_id
                WHERE u.email = :email";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && $password == $user['motdepasse']) {
            return $user;
        }

        return null;
    }
}
