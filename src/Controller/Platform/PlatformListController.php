php
<?php

namespace srcControllerPlatform;

use srcControllerViewController;
use srcServicePlatformPlatformSearcherService;

final class PlatformListController extends ViewController
{
    private PlatformSearcherService $platformSearcherService;

    public function __construct(PlatformSearcherService $platformSearcherService)
    {
        $this->platformSearcherService = $platformSearcherService;
    }

    public function start(): void
    {
        $platforms = $this->platformSearcherService->search();

        $this->call('platform/list.php', ['platforms' => $platforms]);
    }
}