<?php

namespace Symfony\Component\Security\Http\Logout;

if (interface_exists('Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface')) {
    return;
}

interface LogoutSuccessHandlerInterface
{
}
