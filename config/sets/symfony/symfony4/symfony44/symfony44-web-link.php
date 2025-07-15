<?php

declare(strict_types=1);

use Rector\Arguments\Rector\ClassMethod\ReplaceArgumentDefaultValueRector;
use Rector\Arguments\ValueObject\ReplaceArgumentDefaultValue;
use Rector\Config\RectorConfig;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->ruleWithConfiguration(ReplaceArgumentDefaultValueRector::class, [
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'alternate',
            'Symfony\Component\WebLink\Link::REL_ALTERNATE'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'author',
            'Symfony\Component\WebLink\Link::REL_AUTHOR'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'help',
            'Symfony\Component\WebLink\Link::REL_HELP'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'icon',
            'Symfony\Component\WebLink\Link::REL_ICON'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'license',
            'Symfony\Component\WebLink\Link::REL_LICENSE'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'search',
            'Symfony\Component\WebLink\Link::REL_SEARCH'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'stylesheet',
            'Symfony\Component\WebLink\Link::REL_STYLESHEET'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'next',
            'Symfony\Component\WebLink\Link::REL_NEXT'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'prev',
            'Symfony\Component\WebLink\Link::REL_PREV'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'preload',
            'Symfony\Component\WebLink\Link::REL_PRELOAD'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'dns-prefetch',
            'Symfony\Component\WebLink\Link::REL_DNS_PREFETCH'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'preconnect',
            'Symfony\Component\WebLink\Link::REL_PRECONNECT'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'prefetch',
            'Symfony\Component\WebLink\Link::REL_PREFETCH'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'prerender',
            'Symfony\Component\WebLink\Link::REL_PRERENDER'
        ),
        new ReplaceArgumentDefaultValue(
            'Symfony\Component\WebLink\Link',
            '__construct',
            0,
            'mercure',
            'Symfony\Component\WebLink\Link::REL_MERCURE'
        ),
    ]);
};
