<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Auth\CurrentUser;

class UserController
{
    public function __construct(private CurrentUser $currentUser)
    {
    }

    public function profile(): array
    {
        return [$this->currentUser->getId()];
    }
}