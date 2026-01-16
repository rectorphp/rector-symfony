<?php

declare(strict_types=1);

namespace Rector\Symfony\Enum;

final class SymfonyAnnotation
{
    public const string ROUTE = 'Symfony\Component\Routing\Annotation\Route';

    public const string TWIG_TEMPLATE = 'Symfony\Bridge\Twig\Attribute\Template';

    public const string MAP_ENTITY = 'Symfony\Bridge\Doctrine\Attribute\MapEntity';

    public const string TEMPLATE = 'Sensio\Bundle\FrameworkExtraBundle\Configuration\Template';
}
