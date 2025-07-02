php
<?php

namespace src\Entity\User\Exception;

use Exception;

final readonly class UserNotFoundException extends Exception
{
    public function __construct(int $id)
    {
        parent::__construct("User with ID {$id} not found.");
    }
}