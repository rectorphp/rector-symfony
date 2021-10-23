<?php

declare(strict_types=1);

use Rector\Symfony\Set\SymfonyLevelSetList;
use Rector\Symfony\Set\SymfonySetList;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(SymfonySetList::SYMFONY_51);
    $containerConfigurator->import(SymfonyLevelSetList::UP_TO_SYMFONY_50);
};
