<?php

namespace Domain\CombineIngredient;

class CombineIngredientBuilder
{
    public function combine(array $array, int $length): array
    {
        $combinations = [];
        $numElements = count($array);

        $this->generateCombinations([], 0, $array, $length, $numElements, $combinations);

        return $combinations;
    }

    private function generateCombinations(
        array $currentCombination,
        int $startIndex,
        array $array,
        int $length,
        int $numElements,
        array &$combinations
    ): void {
        // Если текущая комбинация достигла требуемой длины, добавляем ее в результат
        if (count($currentCombination) === $length) {
            $combinations[] = $currentCombination;
            return;
        }

        // Создаем комбинации, начиная с указанного индекса
        for ($i = $startIndex; $i < $numElements; $i++) {
            $newCombination = array_merge($currentCombination, [$array[$i]]);
            $this->generateCombinations($newCombination, $i + 1, $array, $length, $numElements, $combinations);
        }
    }
}