<?php

namespace StoreManagerPro\Src\Repository;

use StoreManagerPro\Src\Entity\Client;

class ClientRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct("client");
    }

    public function findAllClient(): array
    {
        $results = $this->findAll();

        $clients = [];
        foreach ($results as $client) {
            $clients[] = new Client(
                $client["nom"],
                $client["telephone"],
                $client["adresse"],
                (float)$client["encoursTotal"],
                (float)$client["limiteCredit"],
                (int)$client["id"]
            );
        }
        return $clients;
    }

    public function insert(Client $client): bool
    {
        $data = [
            'nom' => $client->getNom(),
            'telephone' => $client->getTelephone(),
            'adresse' => $client->getAdresse(),
            'encoursTotal' => $client->getEncoursTotal()
        ];

        return $this->save($data);
    }
}
