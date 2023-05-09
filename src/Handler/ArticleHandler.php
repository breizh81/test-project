<?php

namespace App\Handler;

use App\Repository\ArticleRepositoryInterface;

class ArticleHandler
{
    private ArticleRepositoryInterface $articleRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
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
