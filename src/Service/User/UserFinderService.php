php
<?php

namespace srcServiceUser;

use srcModelUser\UserModel;
use srcEntityUser\User;
use srcEntityUser\Exception\UserNotFoundException;

final class UserFinderService
{
    private UserModel $userModel;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    public function find(int $id): User
    {
        $user = $this->userModel->find($id);

        if ($user === null) {
            throw new UserNotFoundException($id);
        }

        return $user;
    }
}