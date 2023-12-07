<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\Input\RegisterUserInput;
use App\User\App\Query\UserQueryServiceInterface;
use App\User\App\Service\UserAppService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        $user = $this->getAuthUser();
        return $this->redirectToRoute('main_page', ["linkName" => $user->getLinkName()]);
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

    public function mainPage(): Response
    {
        return $this->render('user/user-page.html.twig');
    }
}