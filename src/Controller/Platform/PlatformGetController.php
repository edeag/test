php
<?php

namespace srcControllerPlatform;

use srcControllerViewController;
use srcServicePlatform\PlatformFinderService;
use srcEntityPlatform\Platform;
use srcEntityPlatform\Exception\PlatformNotFoundException;

final class PlatformGetController extends ViewController
{
    private PlatformFinderService $platformFinderService;

    public function __construct(PlatformFinderService $platformFinderService)
    {
        $this->platformFinderService = $platformFinderService;
    }

    public function start(int $id): void
    {
        try {
            $platform = $this->platformFinderService->find($id);
            parent::call(["platform" => $platform]);
        } catch (PlatformNotFoundException $e) {
            // Handle the case where the platform is not found
            // You might want to render a specific error view here
            echo "Error: " . $e->getMessage();
        }
    }
}