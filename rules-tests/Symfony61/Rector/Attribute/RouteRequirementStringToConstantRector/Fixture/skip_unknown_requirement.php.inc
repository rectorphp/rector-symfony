<?php

namespace Rector\Symfony\Tests\Symfony61\Rector\Attribute\RouteRequirementStringToConstantRector\Fixture;

use Symfony\Component\Routing\Attribute\Route;

final class SkipUnknownRequirement
{
    #[Route('/detail/{slug}', requirements: [
        'slug' => '[a-z]{3}',
    ])]
    public function detail()
    {
    }
}
