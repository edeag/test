php
<?php

namespace srcControllerAdminUser;

use srcControllerViewController;
use srcServiceUser\UserCreatorService;

final class UserCreateController extends ViewController
{
    private UserCreatorService $userCreatorService;

    public function __construct(UserCreatorService $userCreatorService)
    {
        $this->userCreatorService = $userCreatorService;
    }

    public function start(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle POST request for user creation
            $userData = $_POST; // Assuming form data is in $_POST

            // Basic validation (you'll need more robust validation)
            if (
                isset($userData['username'], $userData['email'], $userData['nombre'], $userData['apellido']) &&
                !empty($userData['username']) &&
                !empty($userData['email']) &&
                !empty($userData['nombre']) &&
                !empty($userData['apellido'])
            ) {
                try {
                    $this->userCreatorService->create($userData);
                    // Redirect to user list or show success
                    header('Location: /admin/users'); // Example redirect
                    exit;
                } catch (\Exception $e) {
                    // Handle creation errors
                    $errorMessage = "Error creating user: " . $e->getMessage();
                    $this->call("admin/user/form", ['error' => $errorMessage, 'userData' => $userData]);
                }
            } else {
                // Handle validation errors
                $errorMessage = "Please fill in all required fields.";
                $this->call("admin/user/form", ['error' => $errorMessage, 'userData' => $userData]);
            }
        } else {
            // Handle GET request to display the creation form
            $this->call("admin/user/form");
        }
    }
}