php
<?php

namespace srcModelCategory;

use srcEntityCategory\Category;
use srcInfrastructureDatabase\Client as DatabaseClient;

class CategoryModel
{
    private DatabaseClient $databaseClient;

    public function __construct(DatabaseClient $databaseClient)
    {
        $this->databaseClient = $databaseClient;
    }

    public function toEntity(array $primitive): ?Category
    {
        if (empty($primitive)) {
            return null;
        }

        return new Category(
            $primitive['id_categoria'],
            $primitive['nombre']
        );
    }

    public function find(int $id): ?Category
    {
        $sql = "SELECT * FROM Categorias WHERE id_categoria = ?";
        $params = [$id];
        $result = $this->databaseClient->query($sql, $params);

        if (empty($result)) {
            return null;
        }

        return $this->toEntity($result[0]);
    }

    public function search(array $criteria = []): array
    {
        $sql = "SELECT * FROM Categorias";
        $params = [];
        // Basic implementation without handling criteria
        $results = $this->databaseClient->query($sql, $params);

        $entities = [];
        foreach ($results as $result) {
            $entity = $this->toEntity($result);
            if ($entity) {
                $entities[] = $entity;
            }
        }

        return $entities;
    }

    public function create(array $data): int
    {
        $sql = "INSERT INTO Categorias (nombre) VALUES (?)";
        $params = [$data['nombre']];
        $this->databaseClient->query($sql, $params);
        // This assumes the last insert ID is returned, which depends on the database client implementation
        return $this->databaseClient->pdo->lastInsertId();
    }

    public function update(int $id, array $data): void
    {
        $sql = "UPDATE Categorias SET nombre = ? WHERE id_categoria = ?";
        $params = [$data['nombre'], $id];
        $this->databaseClient->query($sql, $params);
    }
}