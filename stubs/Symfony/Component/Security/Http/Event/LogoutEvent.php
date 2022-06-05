<?php

namespace Symfony\Component\Security\Http\Event;

if (class_exists('Symfony\Component\Security\Http\Event\LogoutEvent')) {
    return;
}

class LogoutEvent
{
}
