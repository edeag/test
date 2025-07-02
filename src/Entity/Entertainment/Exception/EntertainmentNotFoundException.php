php
<?php

declare(strict_types=1);

namespace src\Entity\Entertainment\Exception;

use Exception;

final readonly class EntertainmentNotFoundException extends Exception
{
    public function __construct(int $id)
    {
        parent::__construct("The entertainment with ID {$id} was not found.");
    }
}