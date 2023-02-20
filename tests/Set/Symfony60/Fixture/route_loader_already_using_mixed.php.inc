<?php

use Symfony\Component\Config\Loader\LoaderInterface;

namespace Rector\Tests\TypeDeclaration\Rector\ClassMethod\AddParamTypeDeclarationRector\Fixture;

class ApiRouteLoader implements LoaderInterface
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
?>
-----
