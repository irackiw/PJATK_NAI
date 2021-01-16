<?php

namespace App\Repository;

use App\Entity\Film;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class FilmRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Film::class);
    }

    public function getOrCreate(string $name): Film
    {
        return $this->findOneBy(['name' => $name]) ?? new Film($name);
    }

    public function getUsersCommonMovies(User $user1, User $user2)
    {

    }
}