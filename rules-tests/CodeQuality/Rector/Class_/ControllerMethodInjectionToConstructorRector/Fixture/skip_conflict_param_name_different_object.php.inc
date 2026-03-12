<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SkipConflictParamNameDifferentObject extends AbstractController
{
	public function foo(Foo $service): void
	{
		dump($service);
	}

	public function bar(Bar $service): void
	{
		dump($service);
	}
}
