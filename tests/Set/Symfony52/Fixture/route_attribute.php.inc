<?php

use Symfony\Component\Routing\Annotation\Route;

class SomeController
{
    /**
     * @Route()
     */
    public function someMethod()
    {
    }
}

?>
-----
<?php

use Symfony\Component\Routing\Annotation\Route;

class SomeController
{
    #[\Symfony\Component\Routing\Annotation\Route]
    public function someMethod()
    {
    }
}

?>
