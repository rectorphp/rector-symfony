<?php

declare(strict_types=1);

use Rector\Renaming\Rector\MethodCall\RenameMethodRector;
use Rector\Renaming\ValueObject\MethodCallRename;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(RenameMethodRector::class)
        ->configure([
            new MethodCallRename('Twig_Node', 'getLine', 'getTemplateLine'),
            new MethodCallRename('Twig_Node', 'getFilename', 'getTemplateName'),
            new MethodCallRename('Twig_Template', 'getSource', 'getSourceContext'),
            new MethodCallRename('Twig_Error', 'getTemplateFile', 'getTemplateName'),
            new MethodCallRename('Twig_Error', 'getTemplateName', 'setTemplateName'),
        ]);
};
