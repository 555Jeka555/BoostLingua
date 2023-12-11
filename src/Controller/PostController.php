<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\Input\AddPostInput;
use App\User\App\Query\PostQueryServiceInterface;
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
        private PostQueryServiceInterface $postQueryService,
    )
    {
    }

    public function createPostPage(string $linkName): Response
    {
        $this->isUserAuth();

        $author = $this->userQueryService->findByLinkName($linkName);

        $user = $this->getAuthUser();
        if ($user->getUserId() !== $author->getUserId()) {
            return $this->redirectToRoute('index');
        }

        return $this->render('post/post-form.html.twig', [
                'authorId' => $author->getUserId(),
                'title' => '',
                'body' => '',
            ]
        );
    }

    public function createPost(Request $request): Response
    {
        try {
            $data = json_decode($request->getContent(), true);

            $author = $this->userQueryService->findByUserId((int)$data['authorId']);
            $user = $this->getAuthUser();
            if ($user->getUserId() !== $author->getUserId()) {
                return $this->redirectToRoute('index');
            }

            $input = new AddPostInput(
                null,
                (int)$data['authorId'],
                $data['title'],
                $data['body'],
                null,
            );

            $this->postAppService->createPost($input);
            return $this->redirectToRoute('index');
        } catch (\Exception $e) {
            return new JsonResponse(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function deletePost(int $postId): Response
    {
        $post = $this->postQueryService->findByPostId($postId);
        $user = $this->getAuthUser();
        if ($user->getUserId() !== $post->getAuthorId()) {
            return $this->redirectToRoute('index');
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