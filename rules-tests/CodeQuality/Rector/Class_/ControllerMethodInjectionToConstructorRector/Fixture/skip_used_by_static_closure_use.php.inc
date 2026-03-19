<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\Class_\ControllerMethodInjectionToConstructorRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

final class SkipUsedByStaticClosureUse extends AbstractController
{
	public function example(Foo $foo): Response
	{
		dump($foo);

		$problematic = static function() use ($foo): void {
			dump($foo);
		};

		$problematic();
	}
}
