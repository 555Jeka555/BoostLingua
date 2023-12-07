<?php
declare(strict_types=1);

namespace App\User\Domain\Entity;

class User
{
    private ?int $userId = null;

    public function __construct(
        private string  $firstName,
        private string  $secondName,
        private string  $linkName,
        private ?string $description,
        private string  $email,
        private string  $password,
        private ?string $avatarName,
        private int     $role,
    )
    {
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getSecondName(): string
    {
        return $this->secondName;
    }

    public function setSecondName(string $secondName): void
    {
        $this->secondName = $secondName;
    }

    public function getLinkName(): string
    {
        return $this->linkName;
    }

    public function setLinkName(string $linkName): void
    {
        $this->linkName = $linkName;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getAvatarName(): ?string
    {
        return $this->avatarName;
    }

    public function setAvatarName(?string $avatarName): void
    {
        $this->avatarName = $avatarName;
    }

    public function getRole(): int
    {
        return $this->role;
    }

    public function setRole(int $role): void
    {
        $this->role = $role;
    }
}