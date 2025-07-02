php
<?php

namespace srcControllerAdminEntertainment;

use srcControllerViewController;
use srcServiceEntertainmentEntertainmentDeleterService;
use srcEntityEntertainmentExceptionEntertainmentNotFoundException;

final readonly class EntertainmentDeleteController extends ViewController
{
    private EntertainmentDeleterService $entertainmentDeleterService;

    public function __construct(EntertainmentDeleterService $entertainmentDeleterService)
    {
        $this->entertainmentDeleterService = $entertainmentDeleterService;
    }

    public function start(int $id): void
    {
        try {
            $this->entertainmentDeleterService->delete($id);
            // Redirect to the entertainment list page
            header('Location: /admin/entertainment');
            exit();
        } catch (EntertainmentNotFoundException $e) {
            // Display an error message or redirect to an error page
            echo "Error: " . $e->getMessage();
            // Or $this->render('error_view', ['message' => $e->getMessage()]);
        } catch (\Exception $e) {
            // Handle other potential exceptions during deletion
            echo "An unexpected error occurred: " . $e->getMessage();
            // Or $this->render('error_view', ['message' => 'An unexpected error occurred.']);
        }
    }
}