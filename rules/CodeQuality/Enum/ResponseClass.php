<?php

declare(strict_types=1);

namespace Rector\Symfony\CodeQuality\Enum;

final class ResponseClass
{
    /**
     * @var string
     */
    public const REDIRECT = 'Symfony\Component\HttpFoundation\RedirectResponse';

    /**
     * @var string
     */
    public const BINARY_FILE = 'Symfony\Component\HttpFoundation\BinaryFileResponse';

    public const JSON = 'Symfony\Component\HttpFoundation\JsonResponse';

    public const STREAMED = 'Symfony\Component\HttpFoundation\StreamedResponse';

    public const BASIC = 'Symfony\Component\HttpFoundation\Response';
}
