<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\ParamConverterAttributeToMapEntityAttributeRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReplaceEntity
{
    #[Route('/blog/{blogSlug}', name: 'blog_detail')]
    #[Entity('blog', expr: "repository.findOneBy({'slug': blogSlug})")]
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

namespace Rector\Symfony\Tests\Rector\ClassMethod\ParamConverterAttributeToMapEntityAttributeRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReplaceEntity
{
    #[Route('/blog/{blogSlug}', name: 'blog_detail')]
    public function convert(
        Request $request,
        #[\Symfony\Bridge\Doctrine\Attribute\MapEntity(expr: "repository.findOneBy({'slug': blogSlug})")]
        stdClass $blog,
    ): Response
    {
        return new Response();
    }
}

?>
