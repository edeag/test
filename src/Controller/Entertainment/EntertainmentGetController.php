<?php 

use Src\Service\Entertainment\EntertainmentFinderService;
use Src\Entity\Entertainment\Entertainment;
use Src\Entity\Entertainment\Exception\EntertainmentNotFoundException;

include_once $_SERVER["DOCUMENT_ROOT"].'/src/Controller/ViewController.php';

final readonly class EntertainmentGetController extends Src\Controller\ViewController {
	private EntertainmentFinderService $service;

	public function __construct() {
		// In a real application, you would inject the service here, 
		// likely through a dependency injection container.
		// For now, we'll instantiate it directly for simplicity based on the video.
		$this->service = new EntertainmentFinderService(); 
		parent::__construct("Entertainment/detail");
	}

	public function start(int $id): void 
	{
		try {
			$entertainment = $this->service->find($id);
		} catch (EntertainmentNotFoundException $e) {
			// Handle the not found case, e.g., show a 404 page or an error message
			// For now, let's just display the error message.
			echo "Error: " . $e->getMessage();
			return;
		}
		$data = [
			"entertainment" => $entertainment
		];
		parent::call($data);
	}
}