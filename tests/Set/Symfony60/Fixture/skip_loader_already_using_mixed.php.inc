<?php

namespace Rector\Tests\TypeDeclaration\Rector\ClassMethod\AddParamTypeDeclarationRector\Fixture;

use Symfony\Component\Config\Loader\LoaderInterface;

class ApiLoader implements LoaderInterface
{
    public function load(mixed $resource, ?string $type = null): RouteCollection
    {
        return new RouteCollection();
    }

    public function supports(mixed $resource, ?string $type = null): bool
    {
        return $type === 'api';
    }
}
