<?php

namespace Sensio\Bundle\FrameworkExtraBundle\Configuration;

#[\Attribute(\Attribute::TARGET_METHOD)]
class Template
{
    public function __construct(string $templatePath)
    {

    }
}
