<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
        $menus = [
            "Consulter mon solde",
            "Dépôt d'argent",
            "Transfert d'argent"
        ];

        $pages = [
            "pay",
            "deposit",
            "transfer"
        ];

        $slogan = [
            "simple",
            "rapide",
            "sécurisé"
        ];
        return $this->render('home/index.html.twig', [
            "menus" => $menus,
            "pages" => $pages,
            "slogan" => $slogan
        ]);
    }
}
