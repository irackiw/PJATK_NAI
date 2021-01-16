<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Service\EuclideanDistanceCalculatorService;
use App\Service\RecommendationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecommendationController extends AbstractController
{

    public function __construct(
        private RecommendationService $recommendationService,
        private UserRepository $userRepository,
        private EuclideanDistanceCalculatorService $euclideanDistanceCalculatorService
    ) {
    }

    /**
     * @Route("/recommendations", methods={"POST", "GET"}, name="recommendation_new")
     */
    public function list(Request $request): Response
    {
        $rates = [];
        $form = $this->createForm(
            UserType::class,
            null,
            ['method' => 'POST', 'action' => $this->generateUrl('recommendation_new')]
        );
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            /** @var User $user */
            $user = $data['user'];
            $order = $data['order'];
            $limit = $data['limit'];
            $rates = $this->recommendationService->getRecommendationsForUser($user, $order, $limit);
        }

        return $this->render(
            'recommendation/index.html.twig',
            [
                'rates' => $rates,
                'form' => $form->createView(),
            ]
        );


    }
}