<?php

namespace Domain\CombineIngredient\Entity;

class DishInfo
{
    /**
     * @var IngredientTypeAndValue[]
     */
    private array $ingredients;
    private float $price;

    public function __construct(
        array $ingredients,
        float $price
    ) {
        $this->ingredients = $ingredients;
        $this->price = $price;
    }

    /**
     * @return IngredientTypeAndValue[]
     */
    public function getIngredients(): array
    {
        return $this->ingredients;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}