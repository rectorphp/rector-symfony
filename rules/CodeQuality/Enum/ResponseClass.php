<?php

declare(strict_types=1);

namespace Rector\Symfony\CodeQuality\Enum;

final class ResponseClass
{
    public const string REDIRECT = 'Symfony\Component\HttpFoundation\RedirectResponse';

    public const string BINARY_FILE = 'Symfony\Component\HttpFoundation\BinaryFileResponse';

    public const string JSON = 'Symfony\Component\HttpFoundation\JsonResponse';

    public const string STREAMED = 'Symfony\Component\HttpFoundation\StreamedResponse';

    public const string BASIC = 'Symfony\Component\HttpFoundation\Response';
}
