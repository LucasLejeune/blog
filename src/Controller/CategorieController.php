<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategorieRepository;
use App\Repository\ArticleRepository; 

class CategorieController extends AbstractController
{
    /**
     * @Route("/categories", name="app_categories")
     */
    public function index(CategorieRepository $categorieRepo): Response
    {
        $categories = $categorieRepo->findAll();
        return $this->render('categorie/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/categorie/{id<\d+>}", name="app_categorie")
     */
    public function categorie($id,CategorieRepository $categorieRepo, ArticleRepository $articleRepo): Response
    {
        $articles = $articleRepo->findBy(["categorie" => $id]);
        return $this->render('categorie/categorie.html.twig', [
            'articles' => $articles,
        ]);
    }
}
