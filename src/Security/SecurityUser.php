<?php
declare(strict_types=1);

namespace App\Security;

use App\User\Domain\Entity\UserRole;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class SecurityUser implements UserInterface, PasswordAuthenticatedUserInterface
{
    private UserRole $role;

    public function __construct(
        private int    $userId,
        private string $email,
        private string $password,
        int            $role)
    {
        $this->role = UserRole::getTypeByNumber($role);
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRoles(): array
    {
        if ($this->role === UserRole::ADMIN) {
            return ['ROLE_ADMIN', 'ROLE_USER'];
        }
        return ['ROLE_USER'];
    }

    public function getUsername(): string
    {
        return $this->email;
    }

    public function getSalt()
    {
        return null;
    }

    public function isAdmin(): bool
    {
        return $this->role === UserRole::ADMIN;
    }

    public function isStudent(): bool
    {
        return $this->role === UserRole::USER;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function eraseCredentials()
    {

    }
}