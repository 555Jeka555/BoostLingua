<?php
declare(strict_types=1);

namespace App\User\App\Query\Data;

use App\User\Domain\Entity\UserRole;

class UserData
{
    public function __construct(
        private int      $userId,
        private string   $firstName,
        private string   $secondName,
        private string   $linkName,
        private ?string  $description,
        private string   $email,
        private string   $password,
        private string   $avatarName,
        private UserRole $role,
    )
    {
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getSecondName(): string
    {
        return $this->secondName;
    }

    public function getLinkName(): string
    {
        return $this->linkName;
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

    public function getAvatarName(): string
    {
        return $this->avatarName;
    }

    public function getRole(): UserRole
    {
        return $this->role;
    }
}