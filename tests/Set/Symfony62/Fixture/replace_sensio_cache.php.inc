<?php

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReplaceSensioIsCache
{
    #[Route('/cache', name: 'cache')]
    #[Cache(expired: 'tomorrow')]
    public function cache(): Response
    {
        return new Response();
    }
}

?>
-----
<?php

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReplaceSensioIsCache
{
    #[Route('/cache', name: 'cache')]
    #[\Symfony\Component\HttpKernel\Attribute\Cache(expired: 'tomorrow')]
    public function cache(): Response
    {
        return new Response();
    }
}

?>
