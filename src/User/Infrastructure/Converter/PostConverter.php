<?php
declare(strict_types=1);

namespace App\User\Infrastructure\Converter;

use App\User\App\Query\Data\PostData;
use App\User\Domain\Entity\Post;

class PostConverter
{
    public static function createPostData(Post $post): PostData
    {
        return new PostData(
            $post->getPostId(),
            $post->getSubscribeId(),
            $post->getTitle(),
            $post->getBody(),
            $post->getCover(),
        );
    }
}