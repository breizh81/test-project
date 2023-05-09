<?php

namespace App\Repository;

use App\Document\Article;

interface ArticleRepositoryInterface
{
    public function findById(string $articleId): ?Article;

    public function save(Article $article): void;

    public function delete(Article $article): void;

    public function findAll(): array;
}
