<?php

declare(strict_types=1);

namespace Rector\Symfony\Enum;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

final class SensioAttribute
{
    /**
     * @var string
     */
    public const PARAM_CONVERTER = ParamConverter::class;

    /**
     * @var string
     */
    public const ENTITY = Entity::class;

    /**
     * @var string
     */
    public const METHOD = Method::class;

    /**
     * @var string
     */
    public const TEMPLATE = Template::class;

    /**
     * @var string
     */
    public const IS_GRANTED = IsGranted::class;

    /**
     * @var string
     */
    public const SECURITY = Security::class;
}
