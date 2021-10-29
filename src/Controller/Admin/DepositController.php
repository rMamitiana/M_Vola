<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Deposit;
use App\Form\DepositType;
use App\Repository\DepositRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/depot")
 */
class DepositController extends AbstractController
{
    /**
     * @Route("/", name="deposit_index", methods={"GET"})
     */
    public function index(DepositRepository $depositRepository): Response
    {
        return $this->render('deposit/index.html.twig', [
            'deposits' => $depositRepository->findAll(),
        ]);
    }


    /**
     * @Route("/{id}/valider", name="deposit_validate", methods={"GET", "POST"})
     */
    public function validate(Request $request, Deposit $deposit): Response
    {
        $client = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(["phoneNumber" => $deposit->getPhoneNumber()]);

        $client->setMoney($client->getMoney() + $deposit->getMoney());
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        $entityManager->remove($deposit);
        $entityManager->flush();

        return $this->redirectToRoute('deposit_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{id}", name="deposit_delete", methods={"GET", "POST"})
     */
    public function delete(Request $request, Deposit $deposit): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($deposit);
        $entityManager->flush();

        return $this->redirectToRoute('deposit_index', [], Response::HTTP_SEE_OTHER);
    }
}
