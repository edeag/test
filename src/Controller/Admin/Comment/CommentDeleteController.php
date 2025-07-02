php
<?php

namespace srcControllerAdminComment;

use srcControllerViewController;
use srcServiceComment\CommentDeleterService;
use srcEntityComment\Exception\CommentNotFoundException;

final class CommentDeleteController extends ViewController
{
    private CommentDeleterService $commentDeleterService;

    public function __construct(CommentDeleterService $commentDeleterService)
    {
        $this->commentDeleterService = $commentDeleterService;
    }

    public function start(int $id): void
    {
        try {
            $this->commentDeleterService->delete($id);
            // Redirect to entertainment detail page or show success
            header('Location: /entertainment/' . $_POST['entertainment_id']); // Assuming you pass entertainment_id
            exit;
        } catch (CommentNotFoundException $e) {
            // Handle not found error, e.g., show an error message
            echo "Error: " . $e->getMessage(); // Or render an error view
        } catch (\Exception $e) {
            // Handle other potential errors
            echo "An error occurred: " . $e->getMessage(); // Or render an error view
        }
    }
}