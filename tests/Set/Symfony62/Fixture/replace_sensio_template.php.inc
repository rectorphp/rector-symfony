<?php

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReplaceSensioTemplate
{
    #[Route('/template', name: 'template')]
    #[Template('templates/foo.html.twig', vars: ['bar', 'buz'])]
    public function template($bar, $baz = 'abc', $buz = 'def'): Response
    {
        return new Response();
    }
}

?>
-----
<?php

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReplaceSensioTemplate
{
    #[Route('/template', name: 'template')]
    #[\Symfony\Bridge\Twig\Attribute\Template('templates/foo.html.twig', vars: ['bar', 'buz'])]
    public function template($bar, $baz = 'abc', $buz = 'def'): Response
    {
        return new Response();
    }
}

?>
