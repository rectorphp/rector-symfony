<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture;

use Psr\Log\LoggerInterface;
use Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Source\ParentControllerWithPrivatePromotedProperty;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

final class ParentConstructorMultipleServices extends ParentControllerWithPrivatePromotedProperty
{
    #[Route('/example', name: 'example')]
    public function example(LoggerInterface $logger, TranslatorInterface $translator)
    {
        $logger->log('level', $translator->trans('value'));
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture;

use Psr\Log\LoggerInterface;
use Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Source\ParentControllerWithPrivatePromotedProperty;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

final class ParentConstructorMultipleServices extends ParentControllerWithPrivatePromotedProperty
{
    private \Psr\Log\LoggerInterface $logger;
    private \Symfony\Contracts\Translation\TranslatorInterface $translator;
    #[Route('/example', name: 'example')]
    public function example()
    {
        $this->logger->log('level', $this->translator->trans('value'));
    }
    #[\Symfony\Contracts\Service\Attribute\Required]
    public function autowire(\Psr\Log\LoggerInterface $logger, \Symfony\Contracts\Translation\TranslatorInterface $translator): void
    {
        $this->logger = $logger;
        $this->translator = $translator;
    }
}

?>
