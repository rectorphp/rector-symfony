<?php

declare(strict_types=1);

namespace Symfony\Component\Uid;

if (class_exists('Symfony\Component\Uid\Uuid')) {
    return;
}

class Uuid extends AbstractUid
{
}