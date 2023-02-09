<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\ParamConverterAttributeToMapEntityAttributeRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReplaceParamConverterWithNamedArguments
{
    #[Route('/documents/{document}')]
    #[ParamConverter('document', class: \Document::class, options: ['mapping' => ['document' => 'id']], isOptional: true)]
    public function show(Document $document): Response
    {
        return new Response();
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\ClassMethod\ParamConverterAttributeToMapEntityAttributeRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReplaceParamConverterWithNamedArguments
{
    #[Route('/documents/{document}')]
    public function show(#[\Symfony\Bridge\Doctrine\Attribute\MapEntity(class: \Document::class, isOptional: true, mapping: ['document' => 'id'])]
    Document $document): Response
    {
        return new Response();
    }
}

?>
