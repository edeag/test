php
<?php

namespace srcControllerAdminPlatform;

use srcControllerViewController;
use srcServicePlatformPlatformCreatorService;

final class PlatformCreateController extends ViewController
{
    private PlatformCreatorService $platformCreatorService;

    public function __construct(PlatformCreatorService $platformCreatorService)
    {
        $this->platformCreatorService = $platformCreatorService;
    }

    public function start(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle POST request for creating a platform
            $platformData = [
                'nombre' => $_POST['nombre'] ?? null,
                // Add other platform fields as needed
            ];

            // Basic validation (more robust validation should be in Service)
            if (!empty($platformData['nombre'])) {
                try {
                    $this->platformCreatorService->create($platformData);
                    // Redirect to platform list or success page
                    header('Location: /admin/platforms');
                    exit();
                } catch (\Exception $e) {
                    // Handle creation errors
                    $this->render('admin/platforms/create', ['error' => $e->getMessage(), 'formData' => $platformData]);
                }
            } else {
                // Handle validation errors
                $this->render('admin/platforms/create', ['error' => 'Platform name is required.', 'formData' => $platformData]);
            }
        } else {
            // Handle GET request for displaying the creation form
            $this->render('admin/platforms/create');
        }
    }
}