<?php

namespace Rector\Symfony\Tests\Routing\Rector\MethodCall\UrlGeneratorReferenceTypeRector\Fixture;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class SkipAlreadyConstant
{
    public function run(UrlGeneratorInterface $urlGenerator)
    {
        return $urlGenerator->generate('homepage', [], UrlGeneratorInterface::ABSOLUTE_URL);
    }
}
