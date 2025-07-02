php
<?php

namespace srcModelPlatform;

use srcEntityPlatform\Platform;
use srcInfrastructureDatabase\Client as DatabaseClient;

class PlatformModel
{
    private DatabaseClient $databaseClient;

    public function __construct(DatabaseClient $databaseClient)
    {
        $this->databaseClient = $databaseClient;
    }

    public function toEntity(array $primitive): ?Platform
    {
        if (empty($primitive)) {
            return null;
        }

        return new Platform(
            $primitive['id_plataforma'],
            $primitive['nombre']
        );
    }

    public function find(int $id): ?Platform
    {
        $sql = "SELECT * FROM plataforma WHERE id_plataforma = :id";
        $params = [':id' => $id];
        $result = $this->databaseClient->query($sql, $params);

        if (empty($result)) {
            return null;
        }

        return $this->toEntity($result[0]);
    }

    public function search(array $criteria = []): array
    {
        $sql = "SELECT * FROM plataforma";
        $params = [];
        // Basic example of applying criteria
        if (!empty($criteria)) {
            $sql .= " WHERE 1";
            foreach ($criteria as $key => $value) {
                $sql .= " AND {$key} = :{$key}";
                $params[":{$key}"] = $value;
            }
        }

        $results = $this->databaseClient->query($sql, $params);
        return array_map([$this, 'toEntity'], $results);
    }

    public function create(array $data): int
    {
        $sql = "INSERT INTO plataforma (nombre) VALUES (:nombre)";
        $params = [':nombre' => $data['nombre']];
        $this->databaseClient->query($sql, $params);
        return (int)$this->databaseClient->query("SELECT LAST_INSERT_ID()")[0]['LAST_INSERT_ID()'];
    }

    public function update(int $id, array $data): void
    {
        $sql = "UPDATE plataforma SET nombre = :nombre WHERE id_plataforma = :id";
        $params = [':nombre' => $data['nombre'], ':id' => $id];
        $this->databaseClient->query($sql, $params);
    }

    public function delete(int $id): void
    {
        $sql = "DELETE FROM plataforma WHERE id_plataforma = :id";
        $params = [':id' => $id];
        $this->databaseClient->query($sql, $params);
    }
}