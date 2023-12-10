<?php
declare(strict_types=1);

namespace App\User\Infrastructure\Query;

use App\User\App\Query\Data\UserData;
use App\User\App\Query\UserQueryServiceInterface;
use App\User\Domain\Entity\User;
use App\User\Domain\Exception\UserNotFoundException;
use App\User\Domain\Repository\UserReadRepositoryInterface;
use App\User\Infrastructure\Converter\UserConverter;

class UserQueryService implements UserQueryServiceInterface
{
    public function __construct(
        private UserReadRepositoryInterface $userReadRepository,
        private UserConverter               $userConverter,
    )
    {
    }

    public function findByUserId(int $userId): UserData
    {
        $user = $this->userReadRepository->findById($userId);
        $this->asserUserExists($user);

        return $this->userConverter::createUserData($user);
    }

    public function findByEmail(string $email): UserData
    {
        $user = $this->userReadRepository->findByEmail($email);
        $this->asserUserExists($user);

        return $this->userConverter::createUserData($user);
    }

    public function findByLinkName(string $linkName): UserData
    {
        $user = $this->userReadRepository->findByLinkName($linkName);
        $this->asserUserExists($user);

        return $this->userConverter::createUserData($user);
    }

    /**
     * @throws UserNotFoundException
     */
    private function asserUserExists(?User $user): void
    {
        if ($user === null) {
            throw new UserNotFoundException();
        }
    }
}