php
<?php

namespace srcServiceComment;

use srcModelComment\CommentModel;
use srcEntityComment\Comment;

final class CommentSearcherService
{
    private CommentModel $commentModel;

    public function __construct(CommentModel $commentModel)
    {
        $this->commentModel = $commentModel;
    }

    /**
     * @return Comment[]
     */
    public function search(array $criteria = []): array
    {
        // TODO: Implement search logic in CommentModel based on criteria
        $comments = $this->commentModel->search($criteria);

        return $comments;
    }
}