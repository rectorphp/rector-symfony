<?php

namespace Rector\Symfony\Tests\Symfony34\Rector\Closure\ContainerGetNameToTypeInTestsRector\Fixture;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

final class SomeTest extends TestCase
{
    public function run()
    {
        /** @var ContainerInterface $container */
        $container = $this->getContainer();
        $someClass = $container->get('some_name');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony34\Rector\Closure\ContainerGetNameToTypeInTestsRector\Fixture;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

final class SomeTest extends TestCase
{
    public function run()
    {
        /** @var ContainerInterface $container */
        $container = $this->getContainer();
        $someClass = $container->get(\App\Some\Type::class);
    }
}

?>
