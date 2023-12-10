<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\Input\AddPostInput;
use App\User\App\Query\Data\UserData;
use App\User\App\Query\UserQueryServiceInterface;
use App\User\App\Service\PostAppService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PostController extends AuthController
{
    public function __construct(
        private PostAppService            $postAppService,
        private UserQueryServiceInterface $userQueryService,

    )
    {
    }

    public function createPostPage(string $linkName): Response
    {
        $this->isUserAuth();

        $author = $this->userQueryService->findByLinkName($linkName);

        $user = $this->getAuthUser();
        if ($user->getUserId() !== $author->getUserId()) {
            return $this->redirectToRoute('main_page', ["linkName" => $user->getLinkName()]);
        }

        return $this->render('post/post-form.html.twig', [
                'title' => '',
                'body' => '',
            ]
        );
    }

    public function createPost(string $linkName, Request $request): Response
    {
        $author = $this->userQueryService->findByLinkName($linkName);
        $user = $this->getAuthUser();
        if ($user->getUserId() !== $author->getUserId()) {
            return $this->redirectToRoute('main_page', ["linkName" => $user->getLinkName()]);
        }

        try {
            $data = json_decode($request->getContent(), true);

            $input = new AddPostInput(
                null,
                $data['title'],
                $data['body'],
                null,
            );

            $this->postAppService->createPost($input);
            return $this->redirectToRoute('login');
        } catch (\Exception $e) {
            return new JsonResponse(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function deletePost(string $linkName, int $postId): Response
    {
        $author = $this->userQueryService->findByLinkName($linkName);
        $user = $this->getAuthUser();
        if ($user->getUserId() !== $author->getUserId()) {
            return $this->redirectToRoute('main_page', ["linkName" => $user->getLinkName()]);
        }

        try {
            $this->postAppService->deletePost($postId);
        } catch (\Exception $e) {
            return new JsonResponse(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        return $this->redirectToRoute('index');
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