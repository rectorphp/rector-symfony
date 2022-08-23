<?php

declare(strict_types=1);

namespace Rector\Symfony\ValueObject;

use PhpParser\Node\Expr\MethodCall;

final class ServiceSetMethodCallMetadata
{
    public function __construct(
        private readonly MethodCall $methodCall,
        private readonly string $serviceName,
        private readonly string $serviceType
    ) {
    }

    public function getMethodCall(): MethodCall
    {
        return $this->methodCall;
    }

    public function getServiceName(): string
    {
        return $this->serviceName;
    }

    public function getServiceType(): string
    {
        return $this->serviceType;
    }
}
