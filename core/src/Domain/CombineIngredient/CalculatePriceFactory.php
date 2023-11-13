<?php

namespace Domain\CombineIngredient;

use Domain\CombineIngredient\Entity\DishInfo;
use Domain\CombineIngredient\Entity\IngredientTypeAndValue;

class CalculatePriceFactory
{
    private GetIngredientsInfoInterface $getIngredientsInfo;

    public function __construct(
        GetIngredientsInfoInterface $getIngredientsInfo
    ) {
        $this->getIngredientsInfo = $getIngredientsInfo;
    }

    /**
     * @param int[][] $ingredientCombinations
     * @return DishInfo[]
     */
    public function calculate(array $ingredientCombinations): array
    {
        $ingredientsInfo = $this->getIngredientsInfo->get();

        $dishInfo = [];
        foreach ($ingredientCombinations as $ingredientCombination) {
            $totalPrice = 0.0;
            $ingredients = [];
            foreach ($ingredientCombination as $ingredientId) {
                $ingredientInfo = $ingredientsInfo[$ingredientId];
                $totalPrice += $ingredientInfo->getPrice();
                $ingredients[] = new IngredientTypeAndValue(
                    $ingredientInfo->getType(),
                    $ingredientInfo->getTitle()
                );
            }
            $dishInfo[] = new DishInfo(
                $ingredients,
                $totalPrice
            );
        }

        return $dishInfo;
    }
}