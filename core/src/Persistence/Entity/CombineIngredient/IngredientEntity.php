<?php

namespace Persistence\Entity\CombineIngredient;

class IngredientEntity
{
    private int $id;
    private string $type;
    private string $title;
    private float $price;

    public function __construct(
        int $id,
        string $type,
        string $title,
        float $price
    ) {
        $this->id = $id;
        $this->type = $type;
        $this->title = $title;
        $this->price = $price;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}