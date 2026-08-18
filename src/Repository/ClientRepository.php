<?php

namespace StoreManagerPro\Src\Repository;

use StoreManagerPro\Src\Core\Database;
use StoreManagerPro\Src\Entity\Client;

class ClientRepository
{
    public static function findAllClient(): array
    {

        $results = Database::getAllData("client");

        $clients = [];
        foreach ($results as $client) {
            $c = new Client();
            $c->setNom($client["nom"]);
            $c->setTelephone($client["telephone"]);
            $c->setAdresse($client["adresse"]);
            $c->setEncoursTotal((float)$client["encourstotal"]);
            $c->setLimiteCredit((float)$client["limitecredit"]);
            $c->setId((int)$client["id"]);

            $clients[] = $c;
        }
        return $clients;
    }

    public static function insert(Client $client): bool
    {
        $data = [
            'nom' => $client->getNom(),
            'telephone' => $client->getTelephone(),
            'adresse' => $client->getAdresse(),
            'encoursTotal' => $client->getEncoursTotal()
        ];

        $sql = "INSERT INTO vente (nom, telephone, adresse, encoursTotal) VALUES (:nom, :telephone, :adresse, :encoursTotal)";
        $latId = Database::executeUpdate($sql, $data);

        return $latId;
    }
}
