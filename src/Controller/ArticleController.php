<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository; 
use App\Repository\CategorieRepository;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article/{id<\d+>}", name="app_article")
     */
    public function index($id, ArticleRepository $articleRepo, CategorieRepository $categorieRepo): Response
    {
        $article = $articleRepo->find($id);
        return $this->render('article/index.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/articles", name="app_articles")
     */
    public function articles(ArticleRepository $articleRepo): Response
    {
        $articles = $articleRepo->findAll();
        return $this->render('article/articles.html.twig', [
            'articles' => $articles,
            
        ]);
    }
}
