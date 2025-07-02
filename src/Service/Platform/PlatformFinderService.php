php
<?php

namespace srcServicePlatform;

use srcModelPlatform\PlatformModel;
use srcEntityPlatform\Platform;
use srcEntityPlatform\Exception\PlatformNotFoundException;

final class PlatformFinderService
{
    private PlatformModel $platformModel;

    public function __construct(PlatformModel $platformModel)
    {
        $this->platformModel = $platformModel;
    }

    public function find(int $id): Platform
    {
        $platform = $this->platformModel->find($id);

        if ($platform === null) {
            throw new PlatformNotFoundException($id);
        }

        return $platform;
    }
}