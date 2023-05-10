<?php

namespace Handler;

use App\Document\Article;
use App\Exception\ArticleException;
use App\Handler\ArticleHandler;
use App\Repository\ArticleRepositoryInterface;
use PHPUnit\Framework\TestCase;

class ArticleHandlerTest extends TestCase
{
    public function testGetArticle(): void
    {
        $this->expectException(ArticleException::class);
        $this->expectExceptionMessage('Aucun article n\'a été trouvé pour cette url.');

        $articleMock = $this->createMock(Article::class);
        $articleMock->expects($this->never())->method('transform');
        $articleRepository = $this->createMock(ArticleRepositoryInterface::class);
        $articleRepository->expects($this->once())->method('findById')->with('id')->willReturn(null);

        $articleHandler = new ArticleHandler($articleRepository);
        $articleHandler->getArticle('id');
    }

    public function testGetArticleWithResult(): void
    {
        $articleMock = $this->createMock(Article::class);
        $articleMock->expects($this->once())->method('transform')->willReturn('url');
        $articleRepository = $this->createMock(ArticleRepositoryInterface::class);
        $articleRepository->expects($this->once())->method('findById')->with('id')->willReturn($articleMock);

        $articleHandler = new ArticleHandler($articleRepository);
        self::assertEquals('url', $articleHandler->getArticle('id'));
    }

    public function testGetArticles(): void
    {
        $articleRepository = $this->createMock(ArticleRepositoryInterface::class);
        $articleRepository->expects($this->once())->method('findAll')->willReturn([]);

        $articleHandler = new ArticleHandler($articleRepository);
        self::assertEquals([], $articleHandler->getArticles());
    }

    public function testGetArticlesWithResult(): void
    {
        $articleMock = $this->createMock(Article::class);
        $articleRepository = $this->createMock(ArticleRepositoryInterface::class);
        $articleRepository->expects($this->once())->method('findAll')->willReturn([$articleMock]);

        $articleHandler = new ArticleHandler($articleRepository);
        self::assertInstanceOf(Article::class, $articleHandler->getArticles()[0]);
    }
}
