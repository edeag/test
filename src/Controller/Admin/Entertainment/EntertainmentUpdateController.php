php
<?php

namespace srcControllerAdminEntertainment;

use srcControllerViewController;
use srcServiceEntertainmentEntertainmentFinderService;
use srcServiceEntertainmentEntertainmentUpdaterService;
use srcServiceCategoryCategorySearcherService;
use srcServicePlatformPlatformSearcherService;
use srcEntityEntertainmentEntertainment;
use srcEntityEntertainmentExceptionEntertainmentNotFoundException;

final class EntertainmentUpdateController extends ViewController
{
    private EntertainmentFinderService $entertainmentFinderService;
    private EntertainmentUpdaterService $entertainmentUpdaterService;
    private CategorySearcherService $categorySearcherService;
    private PlatformSearcherService $platformSearcherService;

    public function __construct(
        EntertainmentFinderService $entertainmentFinderService,
        EntertainmentUpdaterService $entertainmentUpdaterService,
        CategorySearcherService $categorySearcherService,
        PlatformSearcherService $platformSearcherService
    ) {
        parent::__construct();
        $this->entertainmentFinderService = $entertainmentFinderService;
        $this->entertainmentUpdaterService = $entertainmentUpdaterService;
        $this->categorySearcherService = $categorySearcherService;
        $this->platformSearcherService = $platformSearcherService;
    }

    public function start(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handlePostRequest($id);
        } else {
            $this->handleGetRequest($id);
        }
    }

    private function handleGetRequest(int $id): void
    {
        try {
            $entertainment = $this->entertainmentFinderService->find($id);
            $categories = $this->categorySearcherService->search();
            $platforms = $this->platformSearcherService->search();

            $this->call('Admin/Entertainment/update_form.php', [
                'entertainment' => $entertainment,
                'categories' => $categories,
                'platforms' => $platforms
            ]);
        } catch (EntertainmentNotFoundException $e) {
            // Handle not found - display an error view or redirect
            $this->call('error.php', ['message' => $e->getMessage()]);
        } catch (Exception $e) {
            // Handle other potential exceptions
            $this->call('error.php', ['message' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    private function handlePostRequest(int $id): void
    {
        // Basic validation (you'll need more robust validation)
        $nombre = $_POST['nombre'] ?? null;
        $tipo = $_POST['tipo'] ?? null;
        $fecha = $_POST['fecha'] ?? null;
        $final = isset($_POST['final']) ? (bool)$_POST['final'] : false;
        $descripcion = $_POST['descripcion'] ?? null;
        $id_categoria = $_POST['id_categoria'] ?? null;
        $id_plataforma = $_POST['id_plataforma'] ?? null;

        // More thorough validation needed here...

        $updatedData = [
            'nombre' => $nombre,
            'tipo' => $tipo,
            'fecha' => $fecha,
            'final' => $final,
            'descripcion' => $descripcion,
            'id_categoria' => $id_categoria,
            'id_plataforma' => $id_plataforma
        ];

        try {
            $updatedEntertainment = $this->entertainmentUpdaterService->update($id, $updatedData);
            // Redirect to the detail page or list page after successful update
             header('Location: /admin/entertainment/' . $updatedEntertainment->getIdEntretenimiento());
             exit;
        } catch (EntertainmentNotFoundException $e) {
            // Handle not found during update
            $this->call('error.php', ['message' => $e->getMessage()]);
        } catch (Exception $e) {
            // Handle other potential exceptions during update
            $this->call('error.php', ['message' => 'An error occurred during update: ' . $e->getMessage()]);
        }
    }
}