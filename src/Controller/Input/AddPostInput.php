<?php
declare(strict_types=1);

namespace App\Controller\Input;

use App\User\Domain\Service\InputData\AddPostInputInterface;

class AddPostInput implements AddPostInputInterface
{
    public function __construct(
        private ?int    $subscribeId,
        private string  $title,
        private string  $body,
        private ?string $cover,
    )
    {
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