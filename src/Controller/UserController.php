<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\Input\RegisterUserInput;
use App\User\App\Query\UserQueryServiceInterface;
use App\User\App\Service\UserAppService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AuthController
{
    public function __construct(
        private UserAppService            $userAppService,
        private UserQueryServiceInterface $userQueryService,

    )
    {
    }

    public function index(): Response
    {
        $loggedUser = $this->getAuthUser();
        $this->isUserAuth();

        return $this->redirectToRoute('main_page', ["linkName" => $loggedUser->getLinkName()]);
    }

    public function register(Request $request): Response
    {
        try {
            $data = json_decode($request->getContent(), true);

            $input = new RegisterUserInput(
                $data['firstName'],
                $data['secondName'],
                $data['description'],
                $data['email'],
                $data['password'],
                $data['avatarName'] ?? null,
            );

            $this->userAppService->registerUser($input);
            return $this->redirectToRoute('login');
        } catch (\Exception $e) {
            return new JsonResponse(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function mainPage(string $linkName): Response
    {
        $loggedUser = $this->getAuthUser();
        $this->isUserAuth();
        $author = $this->userQueryService->findByLinkName($linkName);

        return $this->render('user/main-page.html.twig', [
                'author' => $author,
                'loggedUser' => $loggedUser,
                'posts' => [],
            ]
        );
    }

    private function isUserAuth(): ?Response
    {
        $user = $this->getAuthUser();
        if ($user === null) {
            return $this->redirectToRoute('login_page');
        }
        return null;
    }
}