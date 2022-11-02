<?php

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReplaceSensioIsGranted
{
    #[Route('/is/granted', name: 'is_granted')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function isGranted(): Response
    {
        return new Response();
    }
}

?>
-----
<?php

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReplaceSensioIsGranted
{
    #[Route('/is/granted', name: 'is_granted')]
    #[\Symfony\Component\Security\Http\Attribute\IsGranted('IS_AUTHENTICATED_FULLY')]
    public function isGranted(): Response
    {
        return new Response();
    }
}

?>
