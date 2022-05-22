<?php

declare(strict_types=1);

namespace Symfony\Component\Routing;

if (class_exists('Symfony\Component\Routing\Route')) {
    return;
}

class Route
{
    /**
     * @return string[]
     */
    public function getSchemes(): array
    {}


    public function getCondition(): string
    {
    }

    public function getRequirements(): array
    {
    }

    public function getHost(): string
    {
    }

    /**
     * @return string[]
     */
    public function getMethods(): array
    {
    }

    public function getDefaults(): array
    {
    }

    public function getPath(): string
    {
    }
}
