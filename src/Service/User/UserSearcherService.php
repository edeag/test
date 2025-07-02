php
<?php

namespace srcServiceUser;

use srcModelUser\UserModel;
use srcEntityUser\User;

final class UserSearcherService
{
    private UserModel $userModel;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    /**
     * @param array $criteria
     * @return User[]
     */
    public function search(array $criteria = []): array
    {
        // This is a basic implementation. The UserModel's search method
        // would need to be implemented to handle the criteria.
        $users = $this->userModel->search($criteria);

        // The model should return an array of User entities.
        // If the model returns primitive arrays, you would transform them here.
        // Example:
        // $entities = [];
        // foreach ($users as $userPrimitive) {
        //     $entities[] = $this->userModel->toEntity($userPrimitive);
        // }
        // return $entities;

        return $users;
    }
}