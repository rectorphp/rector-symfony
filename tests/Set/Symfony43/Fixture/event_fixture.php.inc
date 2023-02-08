<?php

class SomeEventListener
{
    public function someMethod(\Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent $exceptionEvent)
    {
    }
}

?>
-----
<?php

class SomeEventListener
{
    public function someMethod(\Symfony\Component\HttpKernel\Event\ExceptionEvent $exceptionEvent)
    {
    }
}

?>
