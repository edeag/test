php
<?php

namespace srcServiceUser;

use srcModelUser\UserModel;
use srcEntityUser\User;

final class UserCreatorService
{
    private UserModel $userModel;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    public function create(array $userData): User
    {
        // TODO: Add validation for user data
        $newUser = $this->userModel->create($userData);

        return $newUser;
    }
}