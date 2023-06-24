<?php

namespace Rector\Symfony\Tests\Symfony62\Rector\ClassMethod\ParamConverterAttributeToMapEntityAttributeRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReplaceParamConverterWithMapping
{
    #[Route('/blog/{blogSlug}', name: 'blog_detail')]
    #[ParamConverter('blog', options: ['mapping' => ['blogSlug' => 'slug']])]
    public function convert(
        Request $request,
        stdClass $blog,
    ): Response
    {
        return new Response();
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony62\Rector\ClassMethod\ParamConverterAttributeToMapEntityAttributeRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReplaceParamConverterWithMapping
{
    #[Route('/blog/{blogSlug}', name: 'blog_detail')]
    public function convert(
        Request $request,
        #[\Symfony\Bridge\Doctrine\Attribute\MapEntity(mapping: ['blogSlug' => 'slug'])]
        stdClass $blog,
    ): Response
    {
        return new Response();
    }
}

?>
