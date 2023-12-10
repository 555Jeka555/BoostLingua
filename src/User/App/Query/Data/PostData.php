<?php
declare(strict_types=1);

namespace App\User\App\Query\Data;

class PostData
{
    public function __construct(
        private int     $postId,
        private ?int    $subscribeId,
        private string  $title,
        private string  $body,
        private ?string $cover,
    )
    {
    }

    public function getPostId(): int
    {
        return $this->postId;
    }

    public function getSubscribeId(): ?int
    {
        return $this->subscribeId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }
}