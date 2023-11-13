<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Domain\CombineIngredient\CalculatePriceFactory;
use Domain\CombineIngredient\CombineIngredientBuilder;
use Domain\CombineIngredient\GetIngredientIdsGroupByCodeInterface;
use Domain\CombineIngredient\GetIngredientsInfoInterface;
use Persistence\Action\CombineIngredient\GetIngredientIdsGroupByCodeAction;
use Persistence\Action\CombineIngredient\GetIngredientsInfoAction;

return function(ContainerConfigurator $configurator)
{
    $services = $configurator->services()
        ->defaults()
        ->autowire()
        ->autoconfigure()
        ->public();

    $services
        ->alias(GetIngredientIdsGroupByCodeInterface::class, GetIngredientIdsGroupByCodeAction::class)
        ->alias(GetIngredientsInfoInterface::class, GetIngredientsInfoAction::class)
    ;

    $services
        ->set(CombineIngredientBuilder::class)
        ->set(CalculatePriceFactory::class)
    ;
};
