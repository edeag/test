php
<?php

namespace srcServicePlatform;

use srcModelPlatform\PlatformModel;
use srcEntityPlatform\Exception\PlatformNotFoundException;

final class PlatformDeleterService
{
    private PlatformModel $platformModel;

    public function __construct(PlatformModel $platformModel)
    {
        $this->platformModel = $platformModel;
    }

    public function delete(int $id): void
    {
        $platform = $this->platformModel->find($id);

        if ($platform === null) {
            throw new PlatformNotFoundException($id);
        }

        // Assuming PlatformModel has a delete method
        // $this->platformModel->delete($id);
        // You will need to implement the delete method in PlatformModel
    }
}