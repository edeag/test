php
<?php

namespace srcServiceComment;

use srcModelComment\CommentModel;
use srcEntityComment\Comment;
use srcEntityComment\Exception\CommentNotFoundException;

final class CommentFinderService
{
    private CommentModel $commentModel;

    public function __construct(CommentModel $commentModel)
    {
        $this->commentModel = $commentModel;
    }

    public function find(int $id): Comment
    {
        $comment = $this->commentModel->find($id);

        if ($comment === null) {
            throw new CommentNotFoundException($id);
        }

        return $comment;
    }
}