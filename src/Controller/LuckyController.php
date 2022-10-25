<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends AbstractController
{
    /**
     * @Route("/lucky/{nombre<\d+>}", name="app_lucky")
     */
    public function index($nombre): Response
    {
        return $this->render('lucky/index.html.twig', [
            'prenom' => 'Lucas', 
            'nombre' => $nombre,
        ]);
    }

    /**
     * @Route("/bts", name="app_bts")
     */
    public function bts(): Response
    {
        return $this->render('lucky/bts.html.twig',[
            'ecole' => 'Dampierre',
        ]);
    }
}
