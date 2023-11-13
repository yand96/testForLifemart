<?php

namespace App\View;

use Domain\CombineIngredient\Entity\DishInfo;
use Domain\CombineIngredient\Entity\IngredientTypeAndValue;

class DishTranslator
{
    /**
     * @param DishInfo[] $dishesInfo
     * @return array
     */
    public function translateDishesInfo(array $dishesInfo): array
    {
        return array_map(
            fn(DishInfo $dish): array => $this->translateDish($dish),
            $dishesInfo
        );
    }

    private function translateDish(DishInfo $dish): array
    {
        return [
            'products' => array_map(
                static fn(IngredientTypeAndValue $ingredientTypeAndValue): array => [
                    'Type' => $ingredientTypeAndValue->getType(),
                    'Value' => $ingredientTypeAndValue->getTitle(),
                ],
                $dish->getIngredients()
            ),
            'price' => $dish->getPrice(),
        ];
    }
}
