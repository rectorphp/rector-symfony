<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\ParamConverterAttributeToMapEntityAttributeRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReplaceParamConverterWithMoreOptions
{
    #[Route('/blog/{date}/{slug}')]
    #[ParamConverter('post', options: ['exclude' => ['date'], 'entity_manager' => 'foo'])]
    public function show(Post $post, \DateTime $date): Response
    {
        return new Response();
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\ParamConverterAttributeToMapEntityAttributeRector\Fixture;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReplaceParamConverterWithMoreOptions
{
    #[Route('/blog/{date}/{slug}')]
    public function show(#[\Symfony\Bridge\Doctrine\Attribute\MapEntity(exclude: ['date'], entity_manager: 'foo')]
    Post $post, \DateTime $date): Response
    {
        return new Response();
    }
}

?>
