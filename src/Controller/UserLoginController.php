<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class UserLoginController extends AbstractController
{
    /**
     * @Route("/login", name="user_login")
     */
    public function login(): Response
    {
        return $this->render('user_login/login.html.twig');
    }

    /**
     * @Route("/logout", name="user_logout")
     * 
     * @return NULL
     */
    public function logout()
    {
    }
}
