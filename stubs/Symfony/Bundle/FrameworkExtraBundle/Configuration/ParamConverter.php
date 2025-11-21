<?php

namespace Sensio\Bundle\FrameworkExtraBundle\Configuration;

class ParamConverter
{
    /**
     * @param array|string $data
     */
    public function __construct(
        $data = [],
        string $class = null,
        array $options = [],
        bool $isOptional = false,
        string $converter = null
    ) {
    }
}
