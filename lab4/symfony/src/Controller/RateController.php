<?php

namespace App\Controller;

use App\Entity\Rate;
use App\Entity\User;
use App\Form\RateType;
use App\Repository\RateRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RateController extends AbstractController
{
    public function __construct(
        private RateRepository $rateRepository,
        private EntityManagerInterface $entityManager
    ) {
    }

    /**
     * @Route("/", name="rate_list")
     */
    public function list(Request $request, User $user = null): Response
    {
        return $this->render(
            'rate/index.html.twig',
            [
                'rates' => $this->rateRepository->findAll(),
            ]
        );
    }

    /**
     * @Route("/new", name="rate_new")
     */
    public function new(Request $request): Response
    {
        $rate = new Rate();
        $form = $this->createForm(RateType::class, $rate);
        $form->handleRequest($request);
        try {
            if ($form->isSubmitted()) {
                $task = $form->getData();
                $this->entityManager->persist($task);
                $this->entityManager->flush();
                $this->addFlash('success', 'Film rate added');
            }
        } catch (\Throwable $throwable) {
            $this->addFlash('error', $throwable->getMessage());

            return $this->render(
                'rate/new.html.twig',
                [
                    'form' => $form->createView(),
                ]
            );
        }

        return $this->render(
            'rate/new.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}