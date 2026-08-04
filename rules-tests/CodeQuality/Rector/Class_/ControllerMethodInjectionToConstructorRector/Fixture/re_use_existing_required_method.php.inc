<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture;

use Psr\Log\LoggerInterface;
use Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Source\ParentControllerWithPrivatePromotedProperty;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Service\Attribute\Required;
use Symfony\Contracts\Translation\TranslatorInterface;

final class ReUseExistingRequiredMethod extends ParentControllerWithPrivatePromotedProperty
{
    private TranslatorInterface $translator;

    #[Required]
    public function autowireTranslator(TranslatorInterface $translator): void
    {
        $this->translator = $translator;
    }

    #[Route('/example', name: 'example')]
    public function example(LoggerInterface $logger)
    {
        $logger->log('level', $this->translator->trans('value'));
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
use Symfony\Contracts\Service\Attribute\Required;
use Symfony\Contracts\Translation\TranslatorInterface;

final class ReUseExistingRequiredMethod extends ParentControllerWithPrivatePromotedProperty
{
    private TranslatorInterface $translator;
    private \Psr\Log\LoggerInterface $logger;

    #[Required]
    public function autowireTranslator(TranslatorInterface $translator, \Psr\Log\LoggerInterface $logger): void
    {
        $this->translator = $translator;
        $this->logger = $logger;
    }

    #[Route('/example', name: 'example')]
    public function example()
    {
        $this->logger->log('level', $this->translator->trans('value'));
    }
}

?>
