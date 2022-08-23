<?php

declare(strict_types=1);

namespace Rector\Symfony\DataProvider;

final class ServiceNameToTypeUniqueProvider
{
    public function __construct(
        private readonly ServiceMapProvider $serviceMapProvider
    ) {
    }

    /**
     * @return array<string, string>
     */
    public function provide(): array
    {
        $serviceMap = $this->serviceMapProvider->provide();

        $servicesNamesByType = [];
        foreach ($serviceMap->getServices() as $serviceDefinition) {
            $servicesNamesByType[$serviceDefinition->getClass()][] = $serviceDefinition->getId();
        }

        $uniqueServiceNameToType = [];

        foreach ($servicesNamesByType as $serviceType => $serviceNames) {
            if (count($serviceNames) > 1) {
                continue;
            }

            $uniqueServiceNameToType[$serviceNames[0]] = $serviceType;
        }

        return $uniqueServiceNameToType;
    }
}
