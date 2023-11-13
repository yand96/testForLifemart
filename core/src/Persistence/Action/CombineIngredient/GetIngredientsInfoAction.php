<?php

namespace Persistence\Action\CombineIngredient;

use Domain\CombineIngredient\Entity\IngredientInfo;
use Domain\CombineIngredient\GetIngredientsInfoInterface;
use Persistence\Entity\CombineIngredient\IngredientEntity;
use Persistence\Repository\Db\IngredientRepository;

class GetIngredientsInfoAction implements GetIngredientsInfoInterface
{
    private IngredientRepository $ingredientRepository;

    public function __construct(IngredientRepository $ingredientRepository)
    {
        $this->ingredientRepository = $ingredientRepository;
    }

    /**
     * @return IngredientInfo[]
     */
    public function get(): array 
    {
        $result = [];
        foreach ($this->ingredientRepository->getAll() as $ingredientEntity) {
            $result[$ingredientEntity->getId()] = $this->makeDomain($ingredientEntity);
        }

        return $result;
    }

    private function makeDomain(IngredientEntity $ingredientEntity): IngredientInfo
    {
        return new IngredientInfo(
            $ingredientEntity->getId(),
            $ingredientEntity->getType(),
            $ingredientEntity->getTitle(),
            $ingredientEntity->getPrice()
        );
    }
}