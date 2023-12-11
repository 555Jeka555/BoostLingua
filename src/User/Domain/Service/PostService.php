<?php
declare(strict_types=1);

namespace App\User\Domain\Service;

use App\User\Domain\Entity\Post;
use App\User\Domain\Exception\PostNotFoundException;
use App\User\Domain\Repository\PostRepositoryInterface;
use App\User\Domain\Service\InputData\AddPostInputInterface;

class PostService
{
    public function __construct(
        private PostRepositoryInterface $postRepository,
    )
    {
    }

    public function createPost(AddPostInputInterface $input): int
    {
       $post = new Post(
            $input->getSubscribeId(),
            $input->getAuthorId(),
            $input->getTitle(),
            $input->getBody(),
            $input->getCover(),
       );

        return $this->postRepository->add($post);
    }

    /**
     * @throws PostNotFoundException
     */
    public function deletePost(int $postId): void
    {
        $post = $this->postRepository->findById($postId);
        $this->asserPostExists($post);

        $this->postRepository->remove($post);
    }

    /**
     * @throws PostNotFoundException
     */
    private function asserPostExists(?Post $post): void
    {
        if ($post === null) {
            throw new PostNotFoundException();
        }
    }
}