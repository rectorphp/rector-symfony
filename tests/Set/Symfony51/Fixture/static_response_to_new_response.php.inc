<?php

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SomeController
{
    public function someAction(): Response
    {
        return Response::create(['foo' => 'bar'], Response::HTTP_OK);
    }
}

?>
-----
<?php

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SomeController
{
    public function someAction(): Response
    {
        return new Response(['foo' => 'bar'], Response::HTTP_OK);
    }
}

?>
