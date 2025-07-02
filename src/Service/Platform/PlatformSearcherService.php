php
<?php

namespace srcServicePlatform;

use srcModelPlatform\PlatformModel;
use srcEntityPlatform\Platform;

final class PlatformSearcherService
{
    private PlatformModel $platformModel;

    public function __construct(PlatformModel $platformModel)
    {
        $this->platformModel = $platformModel;
    }

    /**
     * @return Platform[]
     */
    public function search(array $criteria = []): array
    {
        // TODO: Implement search logic in PlatformModel based on criteria
        $platforms = $this->platformModel->search($criteria);

        return $platforms;
    }
}