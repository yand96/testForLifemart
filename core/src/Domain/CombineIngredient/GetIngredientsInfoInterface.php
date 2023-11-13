<?php

namespace Domain\CombineIngredient;

use Domain\CombineIngredient\Entity\IngredientInfo;

interface GetIngredientsInfoInterface
{
    /**
     * @return IngredientInfo[]
     */
    public function get(): array;
}