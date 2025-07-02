php
<?php

namespace srcServiceUser;

use srcModelUser\UserModel;
use srcEntityUser\Exception\UserNotFoundException;

final class UserDeleterService
{
    private UserModel $userModel;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    public function delete(int $userId): void
    {
        $user = $this->userModel->find($userId);

        if ($user === null) {
            throw new UserNotFoundException($userId);
        }

        $this->userModel->delete($userId);
    }
}