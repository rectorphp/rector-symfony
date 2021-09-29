<?php

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

class SomeEventListener
{
    public function someMethod(\Symfony\Component\HttpKernel\Event\ExceptionEvent $exceptionEvent)
    {
        $exception = $exceptionEvent->getThrowable();
        $exceptionEvent->setThrowable($exception);
    }
}

?>
