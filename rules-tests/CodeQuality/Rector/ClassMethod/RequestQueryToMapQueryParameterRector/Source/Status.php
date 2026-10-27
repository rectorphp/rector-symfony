<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\CodeQuality\Rector\ClassMethod\RequestQueryToMapQueryParameterRector\Source;

enum Status: string
{
    case Draft = 'draft';
    case Published = 'published';
}
