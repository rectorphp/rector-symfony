<?php

namespace Rector\Symfony\Tests\DependencyInjection\Rector\Trait_\TraitGetByTypeToInjectRector\Fixture;

use Rector\Symfony\Tests\DependencyInjection\Rector\Trait_\TraitGetByTypeToInjectRector\Source\SomeService;

trait TraitGetType
{
    public function configure()
    {
        $someType = $this->get(SomeService::class);
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\DependencyInjection\Rector\Trait_\TraitGetByTypeToInjectRector\Fixture;

use Rector\Symfony\Tests\DependencyInjection\Rector\Trait_\TraitGetByTypeToInjectRector\Source\SomeService;

trait TraitGetType
{
    private \Rector\Symfony\Tests\DependencyInjection\Rector\Trait_\TraitGetByTypeToInjectRector\Source\SomeService $someService;
    /**
     * @required
     */
    public function autowireTraitGetType(\Rector\Symfony\Tests\DependencyInjection\Rector\Trait_\TraitGetByTypeToInjectRector\Source\SomeService $someService): void
    {
        $this->someService = $someService;
    }
    public function configure()
    {
        $someType = $this->someService;
    }
}

?>
