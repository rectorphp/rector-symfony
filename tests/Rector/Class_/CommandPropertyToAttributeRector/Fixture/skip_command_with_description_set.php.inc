<?php

namespace Rector\Symfony\Tests\Rector\Class_\CommandPropertyToAttributeRector\Fixture;

#[\Symfony\Component\Console\Attribute\AsCommand('frozen', 'let it go')]
namespace Rector\Tests\Symfony\Rector\Class_\CommandPropertyToAttributeRector\Fixture;

class Command extends \Symfony\Component\Console\Command\Command
{
}

?>
