<?php

namespace Rector\Symfony\Tests\Rector\Class_\CommandPropertyToAttributeRector\Fixture;

#[\Symfony\Component\Console\Attribute\AsCommand(name: 'sunshine', description: 'sunshine command', aliases: ['sunshine', 'command'], hidden: true)]
class SkipCommandWithAttributesSetWithKeys extends \Symfony\Component\Console\Command\Command
{
}

?>
