<?php
declare(strict_types=1);

namespace App\Controller;

use App\Security\PasswordHasher;
use App\Security\SecurityUser;
use App\User\App\Query\UserQueryServiceInterface;
use App\User\Domain\Entity\UserRole;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AuthController
{
    public function __construct(
        private UserQueryServiceInterface $userQueryService,
        private PasswordHasher            $passwordHasher,
    )
    {
    }

    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('index');
        }

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('auth/auth.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    public function loginPage(): Response
    {
        return $this->render('auth/auth.html.twig');
    }

    public function authLogin(Request $request): Response
    {
        $data = (array)json_decode($request->getContent());
        print_r($data['email']);
        $user = $this->userQueryService->findByEmail($data['email']);
        if ($user !== null) {
            if (!$this->passwordHasher->verify($user->getPassword(), $data['password'])) {
                return $this->render('auth/auth.html.twig');
            }

            $securityUser = new SecurityUser(
                $user->getUserId(),
                $user->getEmail(),
                $user->getPassword(),
                $user->getLinkName(),
                UserRole::getNumberByType($user->getRole()),
            );
            $this->addUser($securityUser);
            return $this->redirectToRoute('index');
        }

        return $this->render('auth/auth.html.twig');
    }

    public function logout(): void
    {
        $this->redirectToRoute('login');
    }
}