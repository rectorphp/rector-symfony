<?php

declare(strict_types=1);

namespace Symfony\Bundle\FrameworkBundle;

if (class_exists('Symfony\Bundle\FrameworkBundle\Client')) {
    return;
}

use Symfony\Component\DomCrawler\Crawler;

final class Client extends \Symfony\Component\HttpKernel\Client
{
    public static function getCrawler(): Crawler
    {
    }
}
