<?php

namespace App\Service;

use App\Entity\EuclideanDistance;
use App\Entity\User;
use App\Repository\RateRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Lock\LockFactory;
use Symfony\Component\Lock\Store\SemaphoreStore;

class EuclideanDistanceCalculatorService
{
    private LockFactory $lockFactory;

    public function __construct(
        private RateRepository $rateRepository,
        private UserRepository $userRepository,
        private EntityManagerInterface $entityManager
    ) {
        $store = new SemaphoreStore();
        $this->lockFactory = new LockFactory($store);
    }

    /**
     * Calculate euclidean distance for all ratings from db
     */
    public function generateEuclideanDistanceScoreForAllRatings()
    {
        $lock = $this->lockFactory->createLock('euclidean-distance-generation');

        if ($lock->acquire()) {
            $usersRates = $this->rateRepository->getUsersRates();
            foreach ($usersRates as $userName => $userRate) {
                foreach ($usersRates as $user2Name => $userRate2) {
                    if ($userRate === $userRate2) {
                        continue;
                    }
                    $rate = $this->computeEuclideanDistanceScoreForUsers($usersRates, $userName, $user2Name);
                    /** @var User $user1 */
                    $user1 = $this->userRepository->findOneBy(['name' => $userName]);
                    /** @var User $user2 */
                    $user2 = $this->userRepository->findOneBy(['name' => $user2Name]);
                    $distance = new EuclideanDistance($user1, $user2, $rate);
                    $this->entityManager->persist($distance);
                    $this->entityManager->flush();
                }
            }
        }

    }

    /**
     * Compute the Euclidean distance score between user1 and user2
     */
    private function computeEuclideanDistanceScoreForUsers(array $rantings, string $user1, string $user2): float
    {
        if (count(array_intersect_key($rantings[$user1], $rantings[$user2])) === 0) {
            return 0;
        }
        $sumOfSquares = 0;
        foreach ($rantings[$user1] as $item => $value) {
            if (array_key_exists($item, $rantings[$user2])) {
                $sumOfSquares += pow($value - $rantings[$user2][$item], 2);
            }
        }

        return 1 / (1 + $sumOfSquares);
    }
}