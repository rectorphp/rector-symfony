<?php

namespace Rector\Symfony\Tests\Symfony34\Rector\Closure\ContainerGetNameToTypeInTestsRector\Fixture;

use PHPUnit\Framework\TestCase;
use Rector\Symfony\Tests\Symfony34\Rector\Closure\ServiceSetStringNameToClassNameRector\Source\SomeServiceType;
use Symfony\Component\DependencyInjection\ContainerInterface;

final class SkipAlreadyType extends TestCase
{
    public function run()
    {
        /** @var ContainerInterface $container */
        $container = $this->getContainer();
        $someClass = $container->get(SomeServiceType::class);
    }
}

