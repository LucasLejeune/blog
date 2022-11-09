<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Form\ArticleType;
use App\Form\CategorieType;
use App\Repository\ArticleRepository; 
use App\Repository\CategorieRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

    /**
     * @Route("/articleAdd", name="add_article")
     */
    public function articleAdd(Request $request, ManagerRegistry $doctrine): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $manager = $doctrine->getManager();
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){
            $article = $form->getData();
            $manager->persist($article);
            $manager->flush(); //execute les requetes de base
        }

        return $this->renderForm('categorie/categorieAdd.html.twig', [
            'form' => $form
        ]);
    }
}
