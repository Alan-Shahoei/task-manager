<?php

namespace App\Middleware;

use App\Auth\CurrentUser;
use Framework\Interfaces\MiddlewareInterface;
use Framework\Response;

class CeoMiddleware implements MiddlewareInterface
{
    public function __construct(private CurrentUser $currentUser)
    {
    }

    public function process(callable $next)
    {
        if (!$this->currentUser->get()->isCeo()) {
            Response::json(
                ['message' => 'You do not have permission to perform this action.'],
                403
            );

            return;
        }

        $next();
    }
}