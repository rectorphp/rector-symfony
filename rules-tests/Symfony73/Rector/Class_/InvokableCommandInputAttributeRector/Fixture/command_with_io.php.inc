<?php

namespace Rector\Tests\Symfony\Symfony73\Rector\Class_\InvokableCommandInputAttributeRector\Fixture;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand('app:my-command')]
final class MyCommand extends Command
{
    #[\Override]
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->info('Great success!');

        return 1;
    }
}
?>
-----
<?php

namespace Rector\Tests\Symfony\Symfony73\Rector\Class_\InvokableCommandInputAttributeRector\Fixture;

use Symfony\Component\Console\Attribute\AsCommand;
 
#[AsCommand('app:my-command')]
final class MyCommand
{
    #[\Override]
    public function __invoke(\Symfony\Component\Console\Style\SymfonyStyle $io): int
    {
        $io->info('Great success!');
        
        return 1;
    }
}
?>
