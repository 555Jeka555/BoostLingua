<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\Input\RegisterUserInput;
use App\User\App\Service\UserAppService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    public function __construct(
        private UserAppService $userAppService,
    )
    {
    }

    public function index(): Response
    {
        return $this->render('index.html.twig');
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
                $data['avatarName'],
            );

            $this->userAppService->registerUser($input);
            return $this->redirect('login');
        } catch (\Exception $e) {
            return new JsonResponse(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

}