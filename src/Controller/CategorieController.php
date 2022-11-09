<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\ArticleRepository; 
use App\Repository\CategorieRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
        $categorie = $categorieRepo->find($id);
        return $this->render('categorie/categorie.html.twig', [
            'categorie' => $categorie,
        ]);
    }
    /**
     * @Route("/categorieAdd", name="add_categorie")
     */
    public function categorieAdd(Request $request, ManagerRegistry $doctrine): Response
    {
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $manager = $doctrine->getManager();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $categorie = $form->getData();

            $manager->persist($categorie);
            $manager->flush(); //execute les requetes de base

        }

        return $this->renderForm('categorie/categorieAdd.html.twig', [
            'form' => $form
        ]);
    }
    
}
