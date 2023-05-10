<?php

namespace App\Handler;

use App\Exception\ArticleException;
use App\Repository\ArticleRepositoryInterface;

class ArticleHandler
{
    public function __construct(private readonly ArticleRepositoryInterface $articleRepository)
    {
    }

    public function getArticle(string $id): ?string
    {
        if (!is_null($article = $this->articleRepository->findById($id))) {
            return $article->transform();
        }

        throw new ArticleException('Aucun article n\'a été trouvé pour cette url.');
    }

    public function getArticles(): array
    {
        return $this->articleRepository->findAll();
    }
}
