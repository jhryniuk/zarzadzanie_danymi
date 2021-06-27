<?php

namespace App\DTO;

use App\Entity\Article;

class ArticleDTO
{
    /**
     * @var Article
     */
    private $article;

    public function set(Article $article): void
    {
        $this->article = $article;
    }

    public function toArray(): ?array
    {
        return [
            'id' => $this->article->getId(),
            'title' => $this->article->getTitle(),
            'content' => $this->article->getContent(),
        ];
    }

    public function toObject(): Article
    {
        return $this->article;
    }
}