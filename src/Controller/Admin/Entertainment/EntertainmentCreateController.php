php
<?php

namespace srcControllerAdminEntertainment;

use srcControllerViewController;
use srcServiceEntertainmentEntertainmentCreatorService;
use srcServiceCategoryCategorySearcherService;
use srcServicePlatformPlatformSearcherService;
use srcEntityEntertainmentEntertainment;
use Exception;

final class EntertainmentCreateController extends ViewController
{
    private EntertainmentCreatorService $entertainmentCreatorService;
    private CategorySearcherService $categorySearcherService;
    private PlatformSearcherService $platformSearcherService;

    public function __construct(
        EntertainmentCreatorService $entertainmentCreatorService,
        CategorySearcherService $categorySearcherService,
        PlatformSearcherService $platformSearcherService
    ) {
        $this->entertainmentCreatorService = $entertainmentCreatorService;
        $this->categorySearcherService = $categorySearcherService;
        $this->platformSearcherService = $platformSearcherService;
        parent::__construct();
    }

    public function start(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handlePost();
        } else {
            $this->handleGet();
        }
    }

    private function handleGet(): void
    {
        try {
            $categories = $this->categorySearcherService->search();
            $platforms = $this->platformSearcherService->search();

            $this->call('admin/entertainment/create_form.php', [
                'categories' => $categories,
                'platforms' => $platforms
            ]);
        } catch (Exception $e) {
            // Handle error (e.g., log and show a generic error view)
            error_log('Error fetching data for entertainment creation form: ' . $e->getMessage());
            $this->call('error/generic.php', ['message' => 'An error occurred while loading the creation form.']);
        }
    }

    private function handlePost(): void
    {
        $data = $_POST; // Basic assumption, proper validation needed

        // Basic validation (more comprehensive validation required)
        if (empty($data['nombre']) || empty($data['tipo']) || empty($data['fecha']) || empty($data['descripcion']) || empty($data['id_categoria']) || empty($data['id_plataforma'])) {
             // Handle validation error, maybe reload the form with errors
            try {
                $categories = $this->categorySearcherService->search();
                $platforms = $this->platformSearcherService->search();
                $this->call('admin/entertainment/create_form.php', [
                    'categories' => $categories,
                    'platforms' => $platforms,
                    'errors' => ['Please fill in all required fields.'],
                    'old_data' => $data
                ]);
            } catch (Exception $e) {
                 error_log('Error fetching data for entertainment creation form after validation error: ' . $e->getMessage());
                 $this->call('error/generic.php', ['message' => 'An error occurred during processing.']);
            }
            return;
        }

        // Basic type casting (more robust handling needed)
        $data['id_categoria'] = (int) $data['id_categoria'];
        $data['id_plataforma'] = (int) $data['id_plataforma'];
        $data['final'] = isset($data['final']); // Assuming 'final' is a checkbox

        try {
            $newEntertainment = $this->entertainmentCreatorService->create($data);

            // Redirect to a success page or the list page
            header('Location: /admin/entertainments');
            exit;

        } catch (Exception $e) {
            // Handle creation error (e.g., log and show an error view)
            error_log('Error creating entertainment: ' . $e->getMessage());
             try {
                $categories = $this->categorySearcherService->search();
                $platforms = $this->platformSearcherService->search();
                $this->call('admin/entertainment/create_form.php', [
                    'categories' => $categories,
                    'platforms' => $platforms,
                    'errors' => ['An error occurred while creating the entertainment. Please try again.'],
                    'old_data' => $data
                ]);
            } catch (Exception $e) {
                 error_log('Error fetching data for entertainment creation form after creation error: ' . $e->getMessage());
                 $this->call('error/generic.php', ['message' => 'An error occurred during processing.']);
            }
        }
    }
}