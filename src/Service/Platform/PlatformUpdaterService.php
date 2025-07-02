php
<?php

namespace srcServicePlatform;

use srcModelPlatform\PlatformModel;
use srcEntityPlatform\Platform;
use srcEntityPlatform\Exception\PlatformNotFoundException;

final class PlatformUpdaterService
{
    private PlatformModel $platformModel;

    public function __construct(PlatformModel $platformModel)
    {
        $this->platformModel = $platformModel;
    }

    /**
     * @param int $platformId
     * @param array $data
     * @return Platform
     * @throws PlatformNotFoundException
     */
    public function update(int $platformId, array $data): Platform
    {
        $platform = $this->platformModel->find($platformId);

        if ($platform === null) {
            throw new PlatformNotFoundException($platformId);
        }

        // Assuming the Model has an update method
        $updatedPlatform = $this->platformModel->update($platformId, $data);

        if ($updatedPlatform === null) {
             // This might indicate an issue in the model's update if find succeeded
             throw new \RuntimeException("Failed to update platform with ID: " . $platformId);
        }

        return $updatedPlatform;
    }
}