<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Symfony30\Rector\MethodCall\FormTypeInstanceToClassConstRector\Source;

final class SomeTypeWithCtor
{
    /**
     * @var int
     */
    private $number;

    public function __construct(int $number)
    {
        $this->number = $number;
    }
}
