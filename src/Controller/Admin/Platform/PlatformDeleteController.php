php
<?php

namespace srcControllerAdminPlatform;

use srcControllerViewController;
use srcServicePlatformPlatformDeleterService;
use srcEntityPlatformExceptionPlatformNotFoundException;

final class PlatformDeleteController extends ViewController
{
    private PlatformDeleterService $platformDeleterService;

    public function __construct(PlatformDeleterService $platformDeleterService)
    {
        $this->platformDeleterService = $platformDeleterService;
    }

    public function start(int $id): void
    {
        try {
            $this->platformDeleterService->delete($id);
            // Redirect to platform list page or display a success message
            header('Location: /admin/platforms');
            exit();
        } catch (PlatformNotFoundException $e) {
            // Handle platform not found error, display an error message or 404 page
            echo "Error: " . $e->getMessage();
        } catch (\Exception $e) {
            // Handle other potential errors during deletion
            echo "An error occurred: " . $e->getMessage();
        }
    }
}