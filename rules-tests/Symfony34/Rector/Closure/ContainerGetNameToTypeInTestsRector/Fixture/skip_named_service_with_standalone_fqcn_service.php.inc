<?php

namespace Rector\Symfony\Tests\Symfony34\Rector\Closure\ContainerGetNameToTypeInTestsRector\Fixture;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

final class SkipNamedServiceWithStandaloneFqcnService extends TestCase
{
    public function run()
    {
        /** @var ContainerInterface $container */
        $container = $this->getContainer();
        $kenshooExtractor = $container->get('app.revenue.kenshoo_extractor');
        $awinExtractor = $container->get('app.revenue.awin_extractor');
    }
}
