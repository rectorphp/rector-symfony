<?php

namespace Rector\Symfony\Tests\Symfony34\Rector\Closure\ContainerGetNameToTypeInTestsRector\Fixture;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

final class SkipNamedServiceWithoutFqcnService extends TestCase
{
    public function run()
    {
        /** @var ContainerInterface $container */
        $container = $this->getContainer();
        $rule = $container->get('rule.engine.payment.options');
    }
}
