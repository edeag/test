php
<?php

namespace srcServiceComment;

use srcModelComment\CommentModel;
use srcEntityComment\Comment;

final class CommentCreatorService
{
    private CommentModel $commentModel;

    public function __construct(CommentModel $commentModel)
    {
        $this->commentModel = $commentModel;
    }

    public function create(array $commentData): Comment
    {
        // TODO: Implement validation and business logic before calling the model
        return $this->commentModel->create($commentData);
    }
}