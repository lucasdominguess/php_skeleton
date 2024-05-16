<?php

declare(strict_types=1);

namespace App\Application\Actions\User;

use Psr\Log\LoggerInterface;
use App\Application\Actions\Action;
use App\Domain\User\UserRepository;
use App\Infrastructure\Persistence\User\Sql;

abstract class UserAction extends Action
{
    protected UserRepository $userRepository;

    public function __construct(LoggerInterface $logger, Sql $sql , UserRepository $userRepository)
    {
        parent::__construct($logger,$sql);
        $this->userRepository = $userRepository;
    }
}
