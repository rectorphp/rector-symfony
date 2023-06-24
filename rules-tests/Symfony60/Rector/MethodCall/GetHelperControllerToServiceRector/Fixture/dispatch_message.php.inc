<?php

namespace Rector\Symfony\Tests\Symfony60\Rector\MethodCall\GetHelperControllerToServiceRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class DispatchMessage extends AbstractController
{
    public function run()
    {
        $productRepository = $this->dispatchMessage('hey');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony60\Rector\MethodCall\GetHelperControllerToServiceRector\Fixture;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class DispatchMessage extends AbstractController
{
    public function __construct(private \Symfony\Component\Messenger\MessageBusInterface $messageBus)
    {
    }
    public function run()
    {
        $productRepository = $this->messageBus->dispatch('hey');
    }
}

?>
