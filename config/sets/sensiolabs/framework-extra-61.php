<?php

declare(strict_types=1);

use Rector\Php80\ValueObject\AnnotationToAttribute;
use Rector\Renaming\Rector\Name\RenameClassRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    // @see https://github.com/sensiolabs/SensioFrameworkExtraBundle/pull/707
    $services->set(\Rector\Php80\Rector\Class_\AnnotationToAttributeRector::class)
        ->configure([
            new AnnotationToAttribute('Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache'),
            new AnnotationToAttribute('Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity'),
            new AnnotationToAttribute('Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted'),
            new AnnotationToAttribute('Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter'),
            new AnnotationToAttribute('Sensio\Bundle\FrameworkExtraBundle\Configuration\Template'),
        ]);
};
