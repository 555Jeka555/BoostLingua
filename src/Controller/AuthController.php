<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;

class AuthController extends AbstractController
{
    protected function addUser(UserInterface $user): void
    {
        session_start();
        $_SESSION["user"] = $user;
    }

    protected function getAuthUser(): ?UserInterface
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        if (!array_key_exists("user", $_SESSION) || $_SESSION["user"] === null) {
            return null;
        }
        return $_SESSION["user"];
    }

    protected function removeUser(): void
    {
        session_start();
        if (!array_key_exists("user", $_SESSION) || $_SESSION["user"] === null) {
            return;
        }
        $_SESSION["user"] = null;

        session_destroy();
    }
}