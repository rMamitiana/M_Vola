<?php

namespace App\Controller;

use App\Form\UserType;
use App\Entity\Deposit;
use App\Entity\User;
use App\Form\DepositType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @IsGranted("ROLE_USER")
 */
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
            "Retrait d'argent",
            "Transfert d'argent"
        ];

        $pages = [
            "pay",
            "deposit",
            "withdrawal",
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


    /**
     * @route("/add", name="deposit", methods={"POST"})
     */
    public function add(Request $request, EntityManagerInterface $manager): Response
    {
        $deposit = new Deposit();
        $money = $request->get("_money");
        $phoneNumber = $this->getUser()->getPhoneNumber();

        $deposit->setMoney($money)
            ->setPhoneNumber($phoneNumber);

        $manager->persist($deposit);
        $manager->flush();

        return $this->redirectToRoute("homepage");
    }

    /**
     * @route("/retrait", name="withdrawal")
     */
    public function withdrawal(Request $request, EntityManagerInterface $manager)
    {
        $user = $this->getUser();
        $money = floatval($user->getMoney()) - floatval($request->get("_username"));

        $user->setMoney("$money");

        $manager->persist($user);
        $manager->flush();

        return $this->redirectToRoute("homepage");
    }

    /**
     * @route("/transfert", name="transfer")
     */
    public function transfer(Request $request, EntityManagerInterface $manager)
    {
        $user = $this->getUser();
        $money = $request->get("_money");
        $phone = $request->get("_username");
        $debitor = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(["phoneNumber" => $phone]);

        $money_user = floatval($user->getMoney()) - floatval($money);
        $money_debitor = floatval($debitor->getMoney()) + floatval($money);

        $user->setMoney("$money_user");
        $debitor->setMoney("$money_debitor");

        $manager->persist($user);
        $manager->persist($debitor);
        $manager->flush();

        return $this->redirectToRoute("homepage");
    }
}
