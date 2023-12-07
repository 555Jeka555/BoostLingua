<?php
declare(strict_types=1);

namespace App\Controller\Input;

use App\User\Domain\Service\InputData\RegisterUserInputInterface;

class RegisterUserInput implements RegisterUserInputInterface
{
    public function __construct(
        private string  $firstName,
        private string  $secondName,
        private ?string $description,
        private string  $email,
        private string  $password,
        private ?string $avatarName,
    )
    {
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getSecondName(): string
    {
        return $this->secondName;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getAvatarName(): ?string
    {
        return $this->avatarName;
    }
}