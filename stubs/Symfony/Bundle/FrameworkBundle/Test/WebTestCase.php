<?php

declare(strict_types=1);

namespace Symfony\Bundle\FrameworkBundle\Test;

if (class_exists('Symfony\Bundle\FrameworkBundle\Test\WebTestCase')) {
    return;
}

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;

abstract class WebTestCase extends KernelTestCase
{
    /**
     * @var Client|KernelBrowser
     */
    protected static $client;

    public static function getClient(): Client
    {
        return self::$client;
    }

    // support both Client and KernelBrowser transformation
    // @see https://github.com/rectorphp/rector/issues/8613
    public static function createClient(array $options = [], array $server = []): KernelBrowser
    {
        return self::$client;
    }
}
