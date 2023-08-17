<?php

namespace Rector\Symfony\Tests\Symfony62\Rector\ClassMethod\ArgumentValueResolverToValueResolverRector\Fixture;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

final class Skip implements ValueResolverInterface
{
    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        if ($request->get('id') !== 'foo') {
            return [];
        }

        return ['bar'];
    }
}

?>
