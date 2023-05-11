<?php

namespace Rector\Symfony\Tests\Rector\New_\RootNodeTreeBuilderRector\Fixture;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;

final class SomethingBetween
{
    public function configure()
    {
        $treeBuilder = new TreeBuilder();

        $middleValue = 100;

        $rootNode = $treeBuilder->root('acme_root');
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Rector\New_\RootNodeTreeBuilderRector\Fixture;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;

final class SomethingBetween
{
    public function configure()
    {
        $treeBuilder = new TreeBuilder('acme_root');

        $middleValue = 100;

        $rootNode = $treeBuilder->getRootNode();
    }
}

?>
