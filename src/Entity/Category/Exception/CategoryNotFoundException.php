php
<?php

namespace srcEntityCategoryException;

use Exception;

final readonly class CategoryNotFoundException extends Exception
{
    public function __construct(int $id)
    {
        parent::__construct("Category with ID {$id} not found.");
    }
}