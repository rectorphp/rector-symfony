<?php

namespace Rector\Symfony\Tests\Symfony62\Rector\ClassMethod\ArgumentValueResolverToValueResolverRector\Fixture;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

final class Replace implements ArgumentValueResolverInterface
{
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return $request->get('id') === 'foo';
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        return ['bar'];
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony62\Rector\ClassMethod\ArgumentValueResolverToValueResolverRector\Fixture;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

final class Replace implements \Symfony\Component\HttpKernel\Controller\ValueResolverInterface
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
