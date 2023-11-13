<?php

namespace Persistence\Action\CombineIngredient;

use Domain\CombineIngredient\GetIngredientIdsGroupByCodeInterface;
use Persistence\Repository\Db\IngredientRepository;

class GetIngredientIdsGroupByCodeAction implements GetIngredientIdsGroupByCodeInterface
{
    private IngredientRepository $ingredientRepository;

    public function __construct(IngredientRepository $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
    }

    public function get(): array 
    {
        $result = [];

        foreach ($this->ingredientRepository->getIdsAndType() as $ingredientInfo) {
            $result[$ingredientInfo["code"]][] = $ingredientInfo["id"];
        }

        return $result;
    }
}