php
<?php

namespace srcEntityPlatformException;

use Exception;

final readonly class PlatformNotFoundException extends Exception
{
    public function __construct(int $id)
    {
        parent::__construct("Platform with ID '{$id}' not found.");
    }
}