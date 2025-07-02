php
<?php

namespace srcServiceUser;

use srcModelUser\UserModel;
use srcEntityUser\User;
use srcEntityUser\Exception\UserNotFoundException;

final class UserUpdaterService
{
    private UserModel $userModel;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    public function update(int $userId, array $userData): User
    {
        $user = $this->userModel->find($userId);

        if ($user === null) {
            throw new UserNotFoundException($userId);
        }

        // Assuming your UserModel has an update method that takes ID and data
        // You will need to implement the actual update logic in the UserModel
        $updatedUser = $this->userModel->update($userId, $userData);

        // After updating, you might want to re-fetch the entity to ensure
        // you have the latest data from the database, or the update method
        // in the model could return the updated entity directly.
        // For now, we'll assume the model's update method returns the updated entity.
        if ($updatedUser === null) {
             // This case should ideally not happen if find didn't return null,
             // but as a safeguard, we can throw an exception.
             throw new UserNotFoundException($userId);
        }

        return $updatedUser;
    }
}