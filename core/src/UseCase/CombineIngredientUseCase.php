<?php

namespace UseCase;

use Domain\CombineIngredient\CalculatePriceFactory;
use Domain\CombineIngredient\CombineIngredientBuilder;
use Domain\CombineIngredient\Entity\DishInfo;
use Domain\CombineIngredient\GetIngredientIdsGroupByCodeInterface;

class CombineIngredientUseCase
{
    public const INGREDIENT_TYPE_D = 'd';
    public const INGREDIENT_TYPE_C = 'c';
    public const INGREDIENT_TYPE_I = 'i';

    private GetIngredientIdsGroupByCodeInterface $getIngredientIdsGroupByCode;
    private CombineIngredientBuilder $combineIngredientBuilder;
    private CalculatePriceFactory $calculatePriceFactory;

    public function __construct(
        GetIngredientIdsGroupByCodeInterface $getIngredientIdsGroupByCode,
        CombineIngredientBuilder $combineIngredientBuilder,
        CalculatePriceFactory $calculatePriceFactory
    ) {
        $this->getIngredientIdsGroupByCode = $getIngredientIdsGroupByCode;
        $this->combineIngredientBuilder = $combineIngredientBuilder;
        $this->calculatePriceFactory = $calculatePriceFactory;
    }

    /**
     * @param string $code
     * @return DishInfo[]
     */
    public function get(string $code): array
    {
        $codeAsArray = str_split(strtolower($code));
        $arrayCountValues = array_count_values($codeAsArray);
        $ingredientIds = $this->getIngredientIdsGroupByCode->get();

        $combineIngredientTypeD = $this->combineIngredientBuilder->combine(
            $ingredientIds[self::INGREDIENT_TYPE_D] ?? [],
            $arrayCountValues[self::INGREDIENT_TYPE_D] ?? 0
        );
        $combineIngredientTypeC = $this->combineIngredientBuilder->combine(
            $ingredientIds[self::INGREDIENT_TYPE_C] ?? [],
            $arrayCountValues[self::INGREDIENT_TYPE_C] ?? 0
        );
        $combineIngredientTypeI = $this->combineIngredientBuilder->combine(
            $ingredientIds[self::INGREDIENT_TYPE_I] ?? [],
            $arrayCountValues[self::INGREDIENT_TYPE_I] ?? 0
        );

        return $this->calculatePriceFactory->calculate(
            $this->combineArrays(
                $combineIngredientTypeD,
                $combineIngredientTypeC,
                $combineIngredientTypeI
            )
        );
    }

    private function combineArrays(array $arr1, array $arr2, array $arr3): array
    {
        $result = [];

        foreach ($arr1 as $val1) {
            foreach ($arr2 as $val2) {
                foreach ($arr3 as $val3) {
                    $result[] = array_merge($val1, $val2, $val3);
                }
            }
        }

        return $result;
    }
}