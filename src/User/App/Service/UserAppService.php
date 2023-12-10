<?php
declare(strict_types=1);

namespace App\User\App\Service;

use App\Common\Transaction\TransactionInterface;
use App\User\Domain\Service\InputData\RegisterUserInputInterface;
use App\User\Domain\Service\UserService;

class UserAppService
{
    public function __construct(
        private UserService          $userService,
        private TransactionInterface $transaction,
    )
    {
    }

    public function registerUser(RegisterUserInputInterface $input): int
    {
        $userId = null;
        $callback = function () use ($input, &$userId): void {
            $userId = $this->userService->createUser($input);
        };

        $this->transaction->execute($callback);
        return $userId;
    }

}