<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategorieRepository;

class CategorieController extends AbstractController
{
    /**
     * @Route("/categories", name="app_categorie")
     */
    public function index(CategorieRepository $categorieRepo): Response
    {
        $categories = $categorieRepo->findAll();;
        return $this->render('categorie/index.html.twig', [
            'categories' => $categories,
        ]);
    }
}
