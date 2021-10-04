<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
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
            "slogan" => $slogan,
            "user" => $this->getUser()
        ]);
    }
}
