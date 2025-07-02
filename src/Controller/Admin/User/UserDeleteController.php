php
<?php

namespace srcControllerAdminUser;

use srcControllerViewController;
use srcServiceUserUserDeleterService;
use srcEntityUserExceptionUserNotFoundException;

final readonly class UserDeleteController extends ViewController
{
    private UserDeleterService $userDeleterService;

    public function __construct(UserDeleterService $userDeleterService)
    {
        $this->userDeleterService = $userDeleterService;
    }

    public function start(int $id): void
    {
        try {
            $this->userDeleterService->delete($id);
            // Redirect to user list or display success message
            header('Location: /admin/users');
            exit;
        } catch (UserNotFoundException $e) {
            // Handle not found error, e.g., display error message
            echo "Error: " . $e->getMessage();
        } catch (\Exception $e) {
            // Handle other potential errors during deletion
            echo "An error occurred: " . $e->getMessage();
        }
    }
}