<?php 

namespace Src\Model\Entertainment;

use Src\Entity\Entertainment\Entertainment;
use Src\Entity\Entertainment\Exception\EntertainmentNotFoundException;
use srcInfrastructureDatabase\Client as DatabaseClient;

final readonly class EntertainmentModel
{
    private DatabaseClient $databaseClient;

    public function __construct(DatabaseClient $databaseClient)
    {
        $this->databaseClient = $databaseClient;
    }

	public function find(int $id): ?Entertainment
	{
		$query = <<<SELECT_QUERY
						SELECT 
							E.id_entretenimiento,
							E.tipo,
							E.fecha,
							E.final,
							E.nombre,
							E.descripcion, 
							E.platform_id,
							E.id_categoria
						FROM 
							entertainments E
						WHERE
							E.entertainment_id = :id
					SELECT_QUERY;

		$parameters = [
			"id" => $id
		];

		$result = $this->databaseClient->query($query, $parameters);

		$entertainmentData = $result[0] ?? null;

		if ($entertainmentData === null) {
			throw new EntertainmentNotFoundException($id);
		}

		return $this->toEntity($entertainmentData);
	}

	public function toEntity(?array $primitive): ?Entertainment
	{
		return new Entertainment(
			$primitive["id_entretenimiento"] ?? 0,
			$primitive["tipo"] ?? '',
			$primitive["fecha"] ?? '',
			(bool)($primitive["final"] ?? false),
			$primitive["name"] ?? '',
			$primitive["description"] ?? '',
			$primitive["id_categoria"] ?? 0,
			$primitive["id_plataforma"] ?? 0
		);
	}

    public function search(): array
    {
        $query = <<<SELECT_QUERY
						SELECT
							E.id_entretenimiento,
							E.tipo,
							E.fecha,
							E.final,
							E.nombre,
							E.descripcion,
							E.id_categoria,
							E.id_plataforma
						FROM
							Entretenimiento E
					SELECT_QUERY;

        $results = $this->databaseClient->query($query);

        $entities = [];
        foreach ($results as $primitive) {
            $entity = $this->toEntity($primitive);
            if ($entity !== null) {
                $entities[] = $entity;
            }
        }

        return $entities;
    }

    public function create(array $data): int
    {
        $query = <<<INSERT_QUERY
            INSERT INTO Entretenimiento (tipo, fecha, final, nombre, descripcion, id_categoria, id_plataforma)
            VALUES (:tipo, :fecha, :final, :nombre, :descripcion, :id_categoria, :id_plataforma)
        INSERT_QUERY;

        $parameters = [
            ":tipo" => $data["tipo"] ?? '',
            ":fecha" => $data["fecha"] ?? '',
            ":final" => (int)($data["final"] ?? false),
            ":nombre" => $data["nombre"] ?? '',
            ":descripcion" => $data["descripcion"] ?? '',
            ":id_categoria" => $data["id_categoria"] ?? null,
            ":id_plataforma" => $data["id_plataforma"] ?? null,
        ];

        $this->databaseClient->query($query, $parameters);

        return $this->databaseClient->getLastInsertId();
    }

    public function update(int $id, array $data): void
    {
        $query = <<<UPDATE_QUERY
            UPDATE Entretenimiento
            SET tipo = :tipo, fecha = :fecha, final = :final, nombre = :nombre, descripcion = :descripcion, id_categoria = :id_categoria, id_plataforma = :id_plataforma
            WHERE id_entretenimiento = :id
        UPDATE_QUERY;

        $parameters = array_merge([":id" => $id], $data);
        $this->databaseClient->query($query, $parameters);
    }

    public function delete(int $id): void
    {
        $this->databaseClient->query("DELETE FROM Entretenimiento WHERE id_entretenimiento = :id", [":id" => $id]);
    }
}