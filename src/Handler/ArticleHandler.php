<?php

namespace App\Handler;

use App\Repository\ArticleRepositoryInterface;

class ArticleHandler
{
    public function __construct(private readonly ArticleRepositoryInterface $articleRepository)
    {
    }

    public function getArticle(string $id): ?string
    {
        return $this->articleRepository->findById($id)?->transform();
    }

    public function getArticles(): array
    {
        return $this->articleRepository->findAll();
    }

}
