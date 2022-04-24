<?php

declare(strict_types=1);

namespace Symfony\Bundle\FrameworkBundle\Test;

if (class_exists('Symfony\Bundle\FrameworkBundle\Test\WebTestCase')) {
    return;
}

use Symfony\Bundle\FrameworkBundle\Client;

abstract class WebTestCase extends KernelTestCase
{
    /**
     * @var Client
     */
    protected static $client;

    public static function getClient(): Client
    {
        return self::$client;
    }
}
