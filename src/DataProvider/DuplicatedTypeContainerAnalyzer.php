<?php

declare(strict_types=1);

namespace Rector\Symfony\DataProvider;

final class DuplicatedTypeContainerAnalyzer
{
    public function __construct(
        private readonly ServiceMapProvider $serviceMapProvider
    ) {
    }

    /**
     * @return string[]
     */
    public function getDuplicatedTypes(): array
    {
        $serviceMap = $this->serviceMapProvider->provide();

        $servicesClasses = [];
        foreach ($serviceMap->getServices() as $serviceDefinition) {
            $servicesClasses[] = $serviceDefinition->getClass();
        }

        $servicesClassesToCount = array_count_values($servicesClasses);

        // remove duplicated items
        $duplicatedServicesToCount = array_filter($servicesClassesToCount, fn ($count) => $count > 1);

        return array_keys($duplicatedServicesToCount);
    }
}
