<?php

namespace App\Controller;

use App\Handler\ArticleHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class ArticleController extends AbstractController
{
    public function __construct(private readonly ArticleHandler $articleHandler)
    {
    }

    /**
     * @Route(methods={"GET"}, name="all")
     */
    public function all(): Response
    {
        return $this->render('articles.html.twig', ['articles' => $this->articleHandler->getArticles()]);
    }

    /**
     * @Route("/articles/{id}", methods={"GET"}, name="get")
     */
    public function get(string $id): Response
    {
        return $this->render('article.html.twig', ['article' => $this->articleHandler->getArticle($id)]);
    }
}
