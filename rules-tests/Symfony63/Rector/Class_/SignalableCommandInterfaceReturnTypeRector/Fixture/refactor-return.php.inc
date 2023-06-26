<?php

namespace Rector\Symfony\Tests\Symfony63\Rector\Class_\SignalableCommandInterfaceReturnTypeRector\Fixture;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\SignalableCommandInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PaymentCommand extends Command implements SignalableCommandInterface
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        return Command::SUCCESS;
    }

    public function getSubscribedSignals(): array
    {
        return [
            SIGINT,
            SIGTERM,
        ];
    }

    public function handleSignal(int $signal): void
    {
        // do something
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony63\Rector\Class_\SignalableCommandInterfaceReturnTypeRector\Fixture;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\SignalableCommandInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PaymentCommand extends Command implements SignalableCommandInterface
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        return Command::SUCCESS;
    }

    public function getSubscribedSignals(): array
    {
        return [
            SIGINT,
            SIGTERM,
        ];
    }

    public function handleSignal(int $signal): int|false
    {
        // do something
        return false;
    }
}

?>
