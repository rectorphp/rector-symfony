<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Trait_\AddTraitGetterReturnTypeBasedOnSetterRequiredRector\Fixture;

use stdClass;
use Symfony\Contracts\Service\Attribute\Required;

trait WithRequiredAttribute
{
    private $service;

    public function getService()
    {
        return $this->service;
    }

    #[Required]
    public function setService(stdClass $stdClass)
    {
        $this->stdClass = $stdClass;
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\CodeQuality\Rector\Trait_\AddTraitGetterReturnTypeBasedOnSetterRequiredRector\Fixture;

use stdClass;
use Symfony\Contracts\Service\Attribute\Required;

trait WithRequiredAttribute
{
    private $service;

    public function getService(): stdClass
    {
        return $this->service;
    }

    #[Required]
    public function setService(stdClass $stdClass)
    {
        $this->stdClass = $stdClass;
    }
}

?>
