<?php

namespace Rector\Symfony\Tests\Set\Symfony44\Fixture;

class SomeEventListener
{
    public function someMethod(\Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent $exceptionEvent)
    {
        $exception = $exceptionEvent->getException();
        $exceptionEvent->setException($exception);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Set\Symfony44\Fixture;

class SomeEventListener
{
    public function someMethod(\Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent $exceptionEvent)
    {
        $exception = $exceptionEvent->getThrowable();
        $exceptionEvent->setThrowable($exception);
    }
}

?>
