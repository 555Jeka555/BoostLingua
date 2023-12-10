<?php
declare(strict_types=1);

namespace App\User\App\Query;

use App\User\App\Query\Data\PostData;

interface PostQueryServiceInterface
{
    public function findByPostId(int $postId): PostData;

    /**
     * @return PostData[]
     */
    public function findByAuthorId(int $authorId): array;

    /**
     * @return PostData[]
     */
    public function findALl(): array;
}