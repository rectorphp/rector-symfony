<?php

namespace Rector\Symfony\Tests\Symfony62\Rector\ClassMethod\ParamConverterAttributeToMapEntityAttributeRector\Fixture;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Routing\Annotation\Route;

class BlogControllerWithParamConverter
{
    #[Route('/blog/archive/{start}/{end}')]
    #[ParamConverter('start', options: ['format' => '!Y-m-d'])]
    #[ParamConverter('end', options: ['format' => '!Y-m-d'])]
    public function archive(\DateTime $start, \DateTime $end)
    {
    }
}
