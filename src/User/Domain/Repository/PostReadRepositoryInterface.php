<?php
declare(strict_types=1);

namespace App\User\Domain\Repository;

use App\User\Domain\Entity\Post;

interface PostReadRepositoryInterface
{
    public function findById(int $postId): ?Post;

    /**
     * @param int $authorId
     * @return Post[]
     */
    public function findByAuthorId(int $authorId): array;

    /**
     * @return Post[]
     */
    public function findAll(): array;
}