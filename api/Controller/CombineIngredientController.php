<?php

namespace App\Controller;

use App\View\DishTranslator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Throwable;
use UseCase\CombineIngredientUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as SymfonyAbstractController;

class CombineIngredientController extends SymfonyAbstractController
{
    private CombineIngredientUseCase $combineIngredientUseCase;
    private DishTranslator $dishTranslator;

    public function __construct(
        CombineIngredientUseCase $combineIngredientUseCase,
        DishTranslator $dishTranslator
    ) {
        $this->combineIngredientUseCase = $combineIngredientUseCase;
        $this->dishTranslator = $dishTranslator;

    }

    public function get(Request $request): JsonResponse
    {
        $body = $request->query->all();

        if (empty($body['code']) || ! is_string($body['code'])) {
            return $this->json(['error' => 'Empty code'], 400);
        }
        
        try {
            $response = $this->combineIngredientUseCase->get(
                $body['code']
            );
        } catch (Throwable) {
            return $this->json(['error' => 'Ops']);
        }

        return $this->json(
            $this->dishTranslator->translateDishesInfo($response)
        );
    }
}