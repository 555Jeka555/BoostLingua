<?php
declare(strict_types=1);

namespace App\User\Domain\Service;

use App\Security\PasswordHasher;
use App\User\Domain\Entity\User;
use App\User\Domain\Entity\UserRole;
use App\User\Domain\Exception\UserAlreadyExistsException;
use App\User\Domain\Repository\UserRepositoryInterface;
use App\User\Domain\Service\InputData\RegisterUserInputInterface;

class UserService
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private PasswordHasher          $passwordHasher,
    )
    {
    }

    public function createUser(RegisterUserInputInterface $input): int
    {
        $userByEmail = $this->userRepository->findByEmail($input->getEmail());
        if ($userByEmail !== null) {
            throw new UserAlreadyExistsException();
        }

        $linkName = $this->getLinkNameByEmail($input->getEmail());
        $user = new User(
            $input->getFirstName(),
            $input->getSecondName(),
            $linkName,
            $input->getDescription(),
            $input->getEmail(),
            $this->passwordHasher->hash($input->getPassword()),
            $input->getAvatarName(),
            UserRole::getNumberByType(UserRole::USER),
        );

        return $this->userRepository->add($user);
    }

    private function getLinkNameByEmail(string $email): string
    {
        $linkName = strpos($email, '@');
        if ($linkName !== false) {
            return substr($email, 0, $linkName);
        }
        return $email;
    }

}