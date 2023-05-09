<?php

namespace App\Repository;

use App\Document\Article;
use Doctrine\ODM\MongoDB\DocumentManager;

final class ArticleRepository implements ArticleRepositoryInterface
{
    private DocumentManager $documentManager;

    public function __construct(DocumentManager $documentManager)
    {
        $this->documentManager = $documentManager;
    }

    public function findById(string $articleId): ?Article
    {
        return $this->documentManager->getRepository(Article::class)->find($articleId);
    }

    public function save(Article $article): void
    {
        $this->documentManager->persist($article);
        $this->documentManager->flush();
    }

    public function delete(Article $article): void
    {
        $this->documentManager->remove($article);
        $this->documentManager->flush();
    }

    public function findAll(): array
    {
        return $this->documentManager->getRepository(Article::class)->findAll();
    }
}
