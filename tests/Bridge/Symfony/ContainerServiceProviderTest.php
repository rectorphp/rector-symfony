<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Bridge\Symfony;

use PHPUnit\Framework\TestCase;
use Rector\Core\Configuration\Option;
use Rector\Core\Configuration\Parameter\ParameterProvider;
use Rector\Core\Configuration\RectorConfigProvider;
use Rector\Core\Exception\ShouldNotHappenException;
use Rector\Symfony\Bridge\Symfony\ContainerServiceProvider;
use Rector\Symfony\Tests\Bridge\Symfony\Fixture\Service1;
use Rector\Symfony\Tests\Bridge\Symfony\Fixture\Service2;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use Webmozart\Assert\InvalidArgumentException;

class ContainerServiceProviderTest extends TestCase
{
    public function testProvideByName(): void
    {
        $containerServiceProvider = $this->createContainerServiceProvider();

        $service = $containerServiceProvider->provideByName('service1');
        $this->assertEquals(Service1::class, $service::class);
    }

    public function testProvideByNameNotExistedService(): void
    {
        $containerServiceProvider = $this->createContainerServiceProvider();

        $this->expectException(ShouldNotHappenException::class);
        $containerServiceProvider->provideByName('service-that-do-not-exists');
    }

    public function testProvideMultipleServices(): void
    {
        $containerServiceProvider = $this->createContainerServiceProvider();

        $service1 = $containerServiceProvider->provideByName('service1');
        $this->assertEquals(Service1::class, $service1::class);

        $service2 = $containerServiceProvider->provideByName('service2');
        $this->assertEquals(Service2::class, $service2::class);
    }

    public function testProvideWithNotExistedContainerPhpFile(): void
    {
        $containerServiceProvider = $this->createContainerServiceProvider([
            Option::SYMFONY_CONTAINER_PHP_PATH_PARAMETER => 'symfony-container-that-do-not-exists.php',
        ]);

        $this->expectException(InvalidArgumentException::class);

        $containerServiceProvider->provideByName('service1');
    }

    /**
     * @param array<mixed> $parameters
     */
    protected function createContainerServiceProvider(array $parameters = []): ContainerServiceProvider
    {
        $parameters = array_merge([
            Option::SYMFONY_CONTAINER_PHP_PATH_PARAMETER => __DIR__ . '/Fixture/symfony-container.php',
        ], $parameters);

        $container = new Container(new ParameterBag($parameters));
        $rectorConfigProvider = new RectorConfigProvider(new ParameterProvider($container));

        return new ContainerServiceProvider($rectorConfigProvider);
    }
}
