<?php

declare(strict_types=1);

use App\Consenta\Infrastructure\Symfony\Security\SecurityUserProvider;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('security', [
        'password_hashers' => [
            PasswordAuthenticatedUserInterface::class => 'auto',
        ],
        'providers' => [
            'app_user_provider' => [
                'id' => SecurityUserProvider::class,
            ],
        ],
        'firewalls' => [
            'dev' => [
                'pattern' => '^/(_(profiler|wdt)|css|images|js)/',
                'security' => false,
                'stateless' => false,
            ],
            'main' => [
                'lazy' => true,
                'provider' => 'app_user_provider',
                'stateless' => false,
                'json_login' => [
                    'check_path' => 'api_login',
                    'username_path' => 'email',
                    'password_path' => 'password',
                ],
            ],
        ],
        'access_control' => null,
    ]);
};
