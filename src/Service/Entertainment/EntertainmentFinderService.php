<?php 

namespace Src\Service\Entertainment;

use Exception;
use Src\Entity\Entertainment\Entertainment;
use Src\Entity\Entertainment\Exception\EntertainmentNotFoundException;
use Src\Model\Entertainment\EntertainmentModel;
use Src\Infrastructure\Database\Client as DatabaseClient;

final readonly class EntertainmentFinderService {
	private EntertainmentModel $model;

	public function __construct(EntertainmentModel $model) {
		$this->model = $model;
	}

	public function find(int $id): Entertainment 
	{
		$entertainment = $this->model->find($id);
		return $entertainment ?? throw new EntertainmentNotFoundException($id);
	}
}