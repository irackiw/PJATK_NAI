<?php

namespace App\Entity;

class User
{
    private string $id;

    public function __construct(private string $name = '')
    {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
