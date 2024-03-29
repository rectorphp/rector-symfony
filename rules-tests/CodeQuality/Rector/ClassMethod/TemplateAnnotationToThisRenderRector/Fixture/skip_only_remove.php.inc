<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class SkipOnlyRemoveController extends AbstractController
{
    /**
     * @Template()
     */
    public function index($value)
    {
        return $this->createWhatever($value);
    }

    private function createWhatever($value)
    {
        return $value;
    }
}
