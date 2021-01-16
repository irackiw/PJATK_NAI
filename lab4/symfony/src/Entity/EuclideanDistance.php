<?php

namespace App\Entity;

class EuclideanDistance
{
    private string $id;

    public function __construct(private User $fromUser, private User $toUser, private float $score)
    {

    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getFromUser(): User
    {
        return $this->fromUser;
    }

    public function getToUser(): User
    {
        return $this->toUser;
    }

    public function getScore(): float
    {
        return $this->score;
    }
}