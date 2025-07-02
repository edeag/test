php
<?php

namespace srcServicePlatform;

use srcModelPlatform\PlatformModel;
use srcEntityPlatform\Platform;

final class PlatformCreatorService
{
    private PlatformModel $platformModel;

    public function __construct(PlatformModel $platformModel)
    {
        $this->platformModel = $platformModel;
    }

    public function create(array $platformData): Platform
    {
        // TODO: Implement data validation before creating
        $platform = $this->platformModel->create($platformData);
        return $platform;
    }
}