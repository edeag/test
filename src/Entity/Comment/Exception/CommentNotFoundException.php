php
<?php

namespace srcEntityCommentException;

use Exception;

final readonly class CommentNotFoundException extends Exception
{
    public function __construct(int $id)
    {
        parent::__construct("Comment with ID " . $id . " not found.");
    }
}