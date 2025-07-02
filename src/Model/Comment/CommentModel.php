php
<?php

namespace srcModelComment;

use srcEntityComment\Comment;
use srcInfrastructureDatabase\Client as DatabaseClient;

class CommentModel

{
    private DatabaseClient $databaseClient;

    public function __construct(DatabaseClient $databaseClient)
    {
        $this->databaseClient = $databaseClient;
    }

    public function toEntity(array $primitive): ?Comment
    {
        if (empty($primitive)) {
            return null;
        }

        return new Comment(
            $primitive['id_comentario'],
            $primitive['mensaje'],
            $primitive['id_entretenimiento'],
            $primitive['calificacion'],
            $primitive['id_usuario'],
            $primitive['fecha_de_comentario']
        );
    }

    public function find(int $id): ?Comment
    {
        $sql = "SELECT * FROM Comentario WHERE id_comentario = :id";
        $params = [':id' => $id];
        $result = $this->databaseClient->query($sql, $params);

        if (empty($result)) {
            return null;
        }

        return $this->toEntity($result[0]);
    }

    public function search(array $criteria = []): array
    {
        $sql = "SELECT * FROM Usuarios";
        $results = $this->dbClient->query($sql);

        return array_map([$this, 'toEntity'], $results);
    }

    public function create(array $userData): int
    {
        $sql = "INSERT INTO Usuarios (username, email, nombre, apellido) VALUES (:username, :email, :nombre, :apellido)";
        $params = [
            ':username' => $userData['username'] ?? null,
            ':email' => $userData['email'] ?? null,
            ':nombre' => $userData['nombre'] ?? null,
            ':apellido' => $userData['apellido'] ?? null,
        ];
        $this->dbClient->query($sql, $params);
        return (int)$this->dbClient->query("SELECT LAST_INSERT_ID()")[0]['LAST_INSERT_ID()'];
    }

    public function update(int $userId, array $userData): void
    {
        $sql = "UPDATE Usuarios SET username = :username, email = :email, nombre = :nombre, apellido = :apellido WHERE id_usuario = :id";
        $params = array_merge([':id' => $userId], $userData);
        $this->dbClient->query($sql, $params);
    }

    public function delete(int $userId): void
    {
        $sql = "DELETE FROM Usuarios WHERE id_usuario = :id";
        $this->dbClient->query($sql, [':id' => $userId]);
    }
}