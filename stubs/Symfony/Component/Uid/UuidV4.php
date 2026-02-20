<?php

declare(strict_types=1);

namespace Symfony\Component\Uid;

if (class_exists('Symfony\Component\Uid\UuidV4')) {
    return;
}

class UuidV4 extends Uuid
{
}