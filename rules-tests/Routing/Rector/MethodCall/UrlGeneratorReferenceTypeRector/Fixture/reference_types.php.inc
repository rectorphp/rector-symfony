<?php

namespace Rector\Symfony\Tests\Routing\Rector\MethodCall\UrlGeneratorReferenceTypeRector\Fixture;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class ReferenceTypes
{
    public function run(UrlGeneratorInterface $urlGenerator)
    {
        $absolute = $urlGenerator->generate('homepage', [], true);
        $path = $urlGenerator->generate('homepage', [], false);
        $relative = $urlGenerator->generate('homepage', [], 'relative');
        $network = $urlGenerator->generate('homepage', [], 'network');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Routing\Rector\MethodCall\UrlGeneratorReferenceTypeRector\Fixture;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class ReferenceTypes
{
    public function run(UrlGeneratorInterface $urlGenerator)
    {
        $absolute = $urlGenerator->generate('homepage', [], \Symfony\Component\Routing\Generator\UrlGeneratorInterface::ABSOLUTE_URL);
        $path = $urlGenerator->generate('homepage', [], \Symfony\Component\Routing\Generator\UrlGeneratorInterface::ABSOLUTE_PATH);
        $relative = $urlGenerator->generate('homepage', [], \Symfony\Component\Routing\Generator\UrlGeneratorInterface::RELATIVE_PATH);
        $network = $urlGenerator->generate('homepage', [], \Symfony\Component\Routing\Generator\UrlGeneratorInterface::NETWORK_PATH);
    }
}

?>
