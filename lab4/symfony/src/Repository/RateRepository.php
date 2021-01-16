<?php

namespace App\Repository;

use App\Entity\Rate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class RateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rate::class);
    }

    public function getUsersRates(): array
    {
        $rates = $this->findAll();
        $usersRates = [];

        /** @var Rate $rate */
        foreach ($rates as $rate){
            $usersRates[$rate->getUser()->getName()][$rate->getFilm()->getName()] = $rate->getRate();
        }

        return $usersRates;
    }
}