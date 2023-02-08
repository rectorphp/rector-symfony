<?php

class SomeEventListener
{
    public function someMethod()
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
    public function someMethod()
    {
        $exception = $exceptionEvent->getThrowable();
        $exceptionEvent->setThrowable($exception);
    }
}

?>
