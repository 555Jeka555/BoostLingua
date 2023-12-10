<?php
declare(strict_types=1);

namespace App\User\Infrastructure\Query;

use App\User\App\Query\Data\PostData;
use App\User\App\Query\PostQueryServiceInterface;
use App\User\Domain\Entity\Post;
use App\User\Domain\Exception\PostNotFoundException;
use App\User\Domain\Repository\PostReadRepositoryInterface;
use App\User\Infrastructure\Converter\PostConverter;

class PostQueryService implements PostQueryServiceInterface
{
    public function __construct(
        private PostReadRepositoryInterface $postReadRepository,
        private PostConverter               $postConverter,
    )
    {
    }

    /**
     * @throws PostNotFoundException
     */
    public function findByPostId(int $postId): PostData
    {
        $post = $this->postReadRepository->findById($postId);
        $this->asserPostExists($post);

        return $this->postConverter::createPostData($post);
    }

    public function findALl(): array
    {
        $posts = $this->postReadRepository->findAll();
        $postsData = [];
        foreach ($posts as $post) {
            $postsData[] = $this->postConverter::createPostData($post);
        }
        return $postsData;
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