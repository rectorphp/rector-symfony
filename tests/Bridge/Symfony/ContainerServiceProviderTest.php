<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Bridge\Symfony;

use PHPUnit\Framework\TestCase;
use Rector\Core\Configuration\Option;
use Rector\Core\Configuration\Parameter\SimpleParameterProvider;
use Rector\Core\Exception\ShouldNotHappenException;
use Rector\Symfony\Bridge\Symfony\ContainerServiceProvider;
use Rector\Symfony\Tests\Bridge\Symfony\Fixture\Service1;
use Rector\Symfony\Tests\Bridge\Symfony\Fixture\Service2;
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
        $containerServiceProvider = $this->createContainerServiceProvider('symfony-container-that-do-not-exists.php');
        $this->expectException(InvalidArgumentException::class);

        $containerServiceProvider->provideByName('service1');
    }

    protected function createContainerServiceProvider(
        ?string $symfonyContainerPhpFilePath = __DIR__ . '/Fixture/symfony-container.php'
    ): ContainerServiceProvider {
        SimpleParameterProvider::setParameter(
            Option::SYMFONY_CONTAINER_PHP_PATH_PARAMETER,
            $symfonyContainerPhpFilePath
        );

        return new ContainerServiceProvider();
    }
}
