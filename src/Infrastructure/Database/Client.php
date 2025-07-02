<?php

namespace srcInfrastructureDatabase;

use PDO;
use PDOException;

class Client
{
    private PDO $pdo;

    public function __construct()
    {
        $host = getenv('DB_HOST') ?: 'localhost';
        $db   = getenv('DB_NAME') ?: 'database';
        $user = getenv('DB_USER') ?: 'user';
        $pass = getenv('DB_PASS') ?: 'password';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function query(string $sql, array $params = []): array
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
}
<?php 

namespace Src\Infrastructure\Database;

use PDO;
use PDOException;

final class Client {

    /** @var PDO[] $activeClients */
    private static array $activeClients = [];

    public function connect(): PDO
    {
        $client = $this->client();

        if ($client === null) {
            $client = $this->connectClient();
        }

        return $client;
    }

    private function client(): ?PDO
    {
        return self::$activeClients[$_ENV['MYSQL_ROOT_USER']] ?? null;
    }


    private function connectClient(): PDO
    {
        try {
            $conn = new PDO(
                $this->generateUrl(),
                $_ENV['MYSQL_ROOT_USER'],
                $_ENV['MYSQL_ROOT_PASSWORD']
            );
            
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            self::$activeClients[$_ENV['MYSQL_ROOT_USER']] = $conn;

            return $conn;
        } catch (PDOException $e) {
            echo "Hubo un error en la base de datos ".$e->getMessage();
            exit();
        }
    }

    private function generateUrl(): string
    {
        return sprintf(
            '%s:host=%s;dbname=%s',
            $_ENV['MYSQL_TYPE'],
            sprintf('%s:%s', $_ENV['MYSQL_HOST'], $_ENV['MYSQL_PORT']),
            $_ENV['MYSQL_DATABASE']
        );
    }
}