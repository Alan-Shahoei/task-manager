<?php

declare(strict_types=1);

use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\SectionMemberRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\RoleRepository;
use App\Repositories\SectionMemberRepository;
use App\Repositories\UserRepository;
use App\Services\TokenService;
use Framework\Connection;
use Framework\Validator;

return [
    Validator::class => fn() => new Validator(),

    PDO::class => fn() => Connection::make(),

    UserRepositoryInterface::class => fn($container) =>
    new UserRepository($container->get(PDO::class)),

    SectionMemberRepositoryInterface::class => fn($container) =>
    new SectionMemberRepository($container->get(PDO::class)),

    RoleRepositoryInterface::class => fn($container) =>
    new RoleRepository($container->get(PDO::class)),

    TokenService::class => fn() => new TokenService($_ENV['JWT_SECRET'], (int) $_ENV['JWT_EXPIRATION']),
];