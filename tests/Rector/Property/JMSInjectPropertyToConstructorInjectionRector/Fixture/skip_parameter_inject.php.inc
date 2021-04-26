<?php

namespace Rector\Symfony\Tests\Rector\Property\JMSInjectPropertyToConstructorInjectionRector\Fixture;

use JMS\DiExtraBundle\Annotation as DI;

class SkipParameterInject
{
    /**
     * @DI\Inject("%kernel.cache_dir%")
     */
    private $cacheDir;
}
