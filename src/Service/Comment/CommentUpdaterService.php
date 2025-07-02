php
<?php

namespace srcServiceComment;

use srcModelComment\CommentModel;
use srcEntityComment\Comment;
use srcEntityComment\Exception\CommentNotFoundException;

final class CommentUpdaterService
{
    private CommentModel $commentModel;

    public function __construct(CommentModel $commentModel)
    {
        $this->commentModel = $commentModel;
    }

    public function update(int $commentId, array $updatedData): Comment
    {
        $existingComment = $this->commentModel->find($commentId);

        if ($existingComment === null) {
            throw new CommentNotFoundException($commentId);
        }

        // In a real application, you would map updatedData to entity properties
        // and then call a method on the model to persist the changes.
        // For now, this is a placeholder.
        // Example:
        // $updatedComment = new Comment(
        //     $existingComment->getIdComentario(),
        //     $updatedData['mensaje'] ?? $existingComment->getMensaje(),
        //     $updatedData['id_entretenimiento'] ?? $existingComment->getIdEntretenimiento(),
        //     $updatedData['calificacion'] ?? $existingComment->getCalificacion(),
        //     $updatedData['id_usuario'] ?? $existingComment->getIdUsuario(),
        //     $existingComment->getFechaDeComentario() // Date might not be updated this way
        // );
        // $this->commentModel->update($updatedComment);
        // return $updatedComment;

        // Placeholder return for demonstration
        // You'll need to implement the actual update logic in the CommentModel
        // and return the updated Comment entity.
        // For now, returning the existing comment to avoid errors.
        // **Replace this with actual update logic.**
         throw new \Exception("Update logic not implemented yet in CommentModel.");
    }
}