php
<?php

namespace srcControllerAdminPlatform;

use srcControllerViewController;
use srcServicePlatform\PlatformFinderService;
use srcServicePlatform\PlatformUpdaterService;
use srcEntityPlatform\Platform;
use srcEntityPlatform\Exception\PlatformNotFoundException;

final readonly class PlatformUpdateController extends ViewController
{
    private PlatformFinderService $platformFinderService;
    private PlatformUpdaterService $platformUpdaterService;

    public function __construct(
        PlatformFinderService $platformFinderService,
        PlatformUpdaterService $platformUpdaterService
    ) {
        parent::__construct();
        $this->platformFinderService = $platformFinderService;
        $this->platformUpdaterService = $platformUpdaterService;
    }

    public function start(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle POST request for updating platform
            $platformData = [
                'nombre' => $_POST['nombre'] ?? null,
                // Add other platform fields as needed
            ];

            try {
                $updatedPlatform = $this->platformUpdaterService->update($id, $platformData);
                // Redirect to platform list or show success message
                header('Location: /admin/platforms');
                exit();
            } catch (PlatformNotFoundException $e) {
                // Handle platform not found during update
                $this->render('error/404', ['message' => $e->getMessage()]);
            } catch (\Exception $e) {
                // Handle other potential errors during update
                $this->render('error/error', ['message' => 'Error updating platform: ' . $e->getMessage()]);
            }
        } else {
            // Handle GET request for displaying update form
            try {
                $platform = $this->platformFinderService->find($id);
                $this->render('admin/platform/update_form', ['platform' => $platform]);
            } catch (PlatformNotFoundException $e) {
                // Handle platform not found for displaying form
                $this->render('error/404', ['message' => $e->getMessage()]);
            } catch (\Exception $e) {
                // Handle other potential errors
                $this->render('error/error', ['message' => 'Error fetching platform for update: ' . $e->getMessage()]);
            }
        }
    }
}