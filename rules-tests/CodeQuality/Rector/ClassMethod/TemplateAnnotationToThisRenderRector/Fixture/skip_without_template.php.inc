<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class WithoutBaseClassAndTemplate
{
    /**
     * @Route("/route", name="route")
     */
    public function index(): array
    {
        return [];
    }
}
