<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Attribute\RouteRequirementStringToConstantRector\Fixture;

use Symfony\Component\Routing\Attribute\Route;

final class UuidRequirement
{
    #[Route('/detail/{id}', requirements: [
        'id' => '[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}',
    ])]
    public function detail()
    {
    }
}

?>
-----
<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Attribute\RouteRequirementStringToConstantRector\Fixture;

use Symfony\Component\Routing\Attribute\Route;

final class UuidRequirement
{
    #[Route('/detail/{id}', requirements: [
        'id' => \Symfony\Component\Routing\Requirement\Requirement::UUID_V4,
    ])]
    public function detail()
    {
    }
}

?>
