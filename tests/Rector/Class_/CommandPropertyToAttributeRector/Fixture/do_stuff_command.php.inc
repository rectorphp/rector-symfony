<?php
namespace App\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;

 #[AsCommand(
     name: 'do:stuff',
     description: 'Do cool stuff',
 )]
 final class DoStuffCommand extends Command
 {
 }
?>
-----
<?php

namespace Rector\Tests\Symfony\Rector\Class_\CommandPropertyToAttributeRector\Fixture;

// what is expected code?
// should remain the same? delete part below ----- (included)

?>
