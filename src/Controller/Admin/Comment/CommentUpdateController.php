php
<?php

namespace srcControllerAdminComment;

use srcControllerViewController;
use srcServiceCommentCommentFinderService;
use srcServiceCommentCommentUpdaterService;
use srcServiceEntertainmentEntertainmentSearcherService;
use srcServiceUserUserSearcherService;
use srcEntityCommentComment;
use srcEntityCommentExceptionCommentNotFoundException;

final class CommentUpdateController extends ViewController
{
    private CommentFinderService $commentFinderService;
    private CommentUpdaterService $commentUpdaterService;
    private EntertainmentSearcherService $entertainmentSearcherService;
    private UserSearcherService $userSearcherService;

    public function __construct(
        CommentFinderService $commentFinderService,
        CommentUpdaterService $commentUpdaterService,
        EntertainmentSearcherService $entertainmentSearcherService,
        UserSearcherService $userSearcherService
    ) {
        $this->commentFinderService = $commentFinderService;
        $this->commentUpdaterService = $commentUpdaterService;
        $this->entertainmentSearcherService = $entertainmentSearcherService;
        $this->userSearcherService = $userSearcherService;
    }

    public function start(int $id): void
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Handle POST request for updating comment
                $commentData = $_POST; // Assuming form data is in $_POST

                // Basic validation (more robust validation should be implemented)
                if (empty($commentData['mensaje']) || empty($commentData['id_entretenimiento']) || empty($commentData['calificacion']) || empty($commentData['id_usuario'])) {
                    // Handle validation error, e.g., show error message on the form
                    $this->call('admin/comment/update_form', [
                        'error' => 'All fields are required.',
                        'comment' => (object)$commentData, // Pass back the data to pre-fill the form
                        'entertainments' => $this->entertainmentSearcherService->search(),
                        'users' => $this->userSearcherService->search(),
                    ]);
                    return;
                }

                // Update the comment
                $updatedComment = $this->commentUpdaterService->update(
                    $id,
                    $commentData
                );

                // Redirect to the entertainment detail page or show success
                // Assuming you want to redirect to the entertainment detail page the comment belongs to
                header('Location: /admin/entertainment/detail/' . $updatedComment->getIdEntretenimiento());
                exit();

            } else {
                // Handle GET request for displaying the update form
                $comment = $this->commentFinderService->find($id);
                $entertainments = $this->entertainmentSearcherService->search();
                $users = $this->userSearcherService->search();

                $this->call('admin/comment/update_form', [
                    'comment' => $comment,
                    'entertainments' => $entertainments,
                    'users' => $users,
                ]);
            }
        } catch (CommentNotFoundException $e) {
            // Handle case where comment is not found
            $this->call('error', ['message' => $e->getMessage()]); // Assuming an error view exists
        } catch (Throwable $e) {
            // Handle other potential errors during update
            $this->call('error', ['message' => 'An error occurred while updating the comment.']);
        }
    }
}