php
<?php

namespace srcControllerAdminComment;

use srcControllerViewController;
use srcServiceCommentCommentCreatorService;
use srcServiceEntertainmentEntertainmentSearcherService;
use srcServiceUserUserSearcherService;

final class CommentCreateController extends ViewController
{
    private CommentCreatorService $commentCreatorService;
    private EntertainmentSearcherService $entertainmentSearcherService;
    private UserSearcherService $userSearcherService;

    public function __construct(
        CommentCreatorService $commentCreatorService,
        EntertainmentSearcherService $entertainmentSearcherService,
        UserSearcherService $userSearcherService
    ) {
        parent::__construct();
        $this->commentCreatorService = $commentCreatorService;
        $this->entertainmentSearcherService = $entertainmentSearcherService;
        $this->userSearcherService = $userSearcherService;
    }

    public function start(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle POST request for comment creation
            $commentData = $_POST; // Basic example, proper validation needed

            try {
                $this->commentCreatorService->create($commentData);
                // Redirect to entertainment detail page or show success
                header('Location: /entertainment/' . $commentData['id_entretenimiento']); // Example redirect
                exit;
            } catch (\Exception $e) {
                // Handle errors (e.g., validation failed, database error)
                $this->render('admin/comment/create_form', [
                    'error' => $e->getMessage(),
                    'formData' => $commentData,
                    'entertainments' => $this->entertainmentSearcherService->search(),
                    'users' => $this->userSearcherService->search()
                ]);
            }
        } else {
            // Handle GET request for displaying the creation form
            try {
                $entertainments = $this->entertainmentSearcherService->search();
                $users = $this->userSearcherService->search();

                $this->render('admin/comment/create_form', [
                    'entertainments' => $entertainments,
                    'users' => $users
                ]);
            } catch (\Exception $e) {
                // Handle errors (e.g., fetching data for dropdowns)
                $this->render('admin/comment/create_form', [
                    'error' => 'Could not load data for the form: ' . $e->getMessage()
                ]);
            }
        }
    }
}