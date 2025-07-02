<?php 
namespace srcModelUser;
namespace Src\Model\User;

use Src\Infrastructure\Database\Client as DatabaseClient;
use Src\Model\DatabaseModel;
use Src\Entity\User\User;

final readonly class UserModel extends DatabaseModel {

    private DatabaseClient $dbClient;

    public function __construct(DatabaseClient $dbClient)
    {
        $this->dbClient = $dbClient;
    }

    public function find(int $id): ?User
    {
        $sql = "SELECT id_usuario, username, email, nombre, apellido FROM Usuarios WHERE id_usuario = :id";

        $parameters = [
            'id' => $id
        ];

        $result = $this->primitiveQuery($query, $parameters);
        
        return $this->toEntity($result[0] ?? null);
    }

    public function findByEmailAndPassword(
        string $email,
        string $password
    ): ?User
    {
        // NOTE: This method is likely for authentication and should be handled carefully (e.g., password hashing)
        $sql = "SELECT id_usuario, username, email, nombre, apellido FROM Usuarios WHERE
                        U.email = :email AND
                        U.password = :password
                SELECT_QUERY;

        $parameters = [
            'email' => $email,
            'password' => $password,
        ];

        $result = $this->primitiveQuery($query, $parameters);
        
        return $this->toEntity($result[0] ?? null);
    }

    public function search(array $criteria = []): array
    {
        $sql = "SELECT id_usuario, username, email, nombre, apellido FROM Usuarios";
        $params = [];
        // Add filtering logic based on $criteria if needed

        $results = $this->dbClient->query($sql, $params);

        return array_map([$this, 'toEntity'], $results);
    }

    public function create(array $data): int
    {
        $sql = "INSERT INTO Usuarios (username, email, nombre, apellido) VALUES (:username, :email, :nombre, :apellido)";
        $params = [
            ':username' => $data['username'],
            ':email' => $data['email'],
            ':nombre' => $data['nombre'],
            ':apellido' => $data['apellido'],
            // Add other fields as necessary
        ];
        $this->dbClient->query($sql, $params);
        return $this->dbClient->lastInsertId(); // Assuming Client has a lastInsertId method
    }

    public function update(int $id, array $data): void
    {
        $sql = "UPDATE Usuarios SET username = :username, email = :email, nombre = :nombre, apellido = :apellido WHERE id_usuario = :id";
        $params = [
            ':id' => $id,
            ':username' => $data['username'],
            ':email' => $data['email'],
            ':nombre' => $data['nombre'],
            ':apellido' => $data['apellido'],
            // Add other fields as necessary
        ];
        $this->dbClient->query($sql, $params);
    }

    public function delete(int $id): void
    {
        $sql = "DELETE FROM Usuarios WHERE id_usuario = :id";
        $params = [':id' => $id];
        $this->dbClient->query($sql, $params);
    }

    public function toEntity(?array $primitive): ?User
    {
        if ($primitive === null) {
            return null;
        }

        return new User(
            $primitive['id'],
            $primitive['email'],
            $primitive['password'],
            $primitive['username'],
            $primitive['apellido']
        );
    }
}