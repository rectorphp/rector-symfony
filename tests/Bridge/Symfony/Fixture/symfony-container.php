<?php

use Symfony\Component\DependencyInjection\Container;
use Rector\Symfony\Tests\Bridge\Symfony\Fixture;

$container = new Container();

$container->set('service1', new Fixture\Service1());
$container->set('service2', new Fixture\Service2());

return $container;