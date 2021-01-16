<?php

namespace App\Service;

use App\Entity\EuclideanDistance;
use App\Entity\User;
use App\Repository\EuclideanDistanceRepository;
use App\Repository\RateRepository;

class RecommendationService
{
    const ORDER_ASC = 'asc';
    const ORDER_DESC = 'desc';

    public function __construct(
        private RateRepository $rateRepository,
        private EuclideanDistanceRepository $euclideanDistanceRepository
    ) {
    }

    public function getRecommendationsForUser(
        User $user,
        string $order = self::ORDER_ASC,
        int $limit = 5
    ): array {
        /** @var EuclideanDistance $bestRelatedUser */
        $bestRelatedUser = $this->euclideanDistanceRepository->findBy(
            ['toUser' => $user],
            ['score' => self::ORDER_DESC],
            1
        );
        if (empty($bestRelatedUser)) {
            throw new \Exception('Euclidean distance not found.');
        }

        return $this->rateRepository->findBy(['user' => $bestRelatedUser[0]->getFromUser()], ['rate' => $order], $limit);
    }
}