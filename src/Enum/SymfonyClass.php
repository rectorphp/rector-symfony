<?php

declare(strict_types=1);

namespace Rector\Symfony\Enum;

final class SymfonyClass
{
    public const string CONTROLLER = 'Symfony\Bundle\FrameworkBundle\Controller\Controller';

    public const string RESPONSE = 'Symfony\Component\HttpFoundation\Response';

    public const string COMMAND = 'Symfony\Component\Console\Command\Command';

    public const string CONTAINER_AWARE_COMMAND = 'Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand';

    public const string EVENT_DISPATCHER_INTERFACE = 'Symfony\Contracts\EventDispatcher\EventDispatcherInterface';

    public const string VALIDATOR_INTERFACE = 'Symfony\Component\Validator\Validator\ValidatorInterface';

    public const string LOGGER_INTERFACE = 'Psr\Log\LoggerInterface';

    public const string JMS_SERIALIZER_INTERFACE = 'JMS\Serializer\SerializerInterface';

    public const string KERNEL_EVENTS_CLASS = 'Symfony\Component\HttpKernel\KernelEvents';

    public const string CONSOLE_EVENTS_CLASS = 'Symfony\Component\Console\ConsoleEvents';

    public const string EVENT_SUBSCRIBER_INTERFACE = 'Symfony\Component\EventDispatcher\EventSubscriberInterface';

    public const string TRANSLATOR_INTERFACE = 'Symfony\Contracts\Translation\TranslatorInterface';

    public const string SERVICE_CONFIGURATOR = 'Symfony\Component\DependencyInjection\Loader\Configurator\ServiceConfigurator';

    public const string SESSION_INTERFACRE = 'Symfony\Component\HttpFoundation\Session\SessionInterface';

    public const string TOKEN_STORAGE_INTERFACE = 'Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface';

    public const string HTTP_KERNEL_INTERFACE = 'Symfony\Component\HttpKernel\HttpKernelInterface';

    public const string HTTP_KERNEL = 'Symfony\Component\HttpKernel\HttpKernel';

    public const string REQUEST = 'Symfony\Component\HttpFoundation\Request';

    public const string ABSTRACT_CONTROLLER = 'Symfony\Bundle\FrameworkBundle\Controller\AbstractController';

    public const string CONTROLLER_TRAIT = 'Symfony\Bundle\FrameworkBundle\Controller\ControllerTrait';

    public const string AUTHORIZATION_CHECKER = 'Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface';

    public const string REQUEST_STACK = 'Symfony\Component\HttpFoundation\RequestStack';

    public const string ABSTRACT_BROWSER = 'Symfony\Component\BrowserKit\AbstractBrowser';

    public const string HTTP_CLIENT = 'Symfony\Component\HttpKernel\Client';

    public const string KERNEL_BROWSER = 'Symfony\Bundle\FrameworkBundle\KernelBrowser';

    public const string FORM_BUILDER = 'Symfony\Component\Form\FormBuilderInterface';

    public const string CONTAINER_CONFIGURATOR = 'Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator';

    public const string PARAMETER_BAG = 'Symfony\Component\HttpFoundation\ParameterBag';

    public const string PARAMETER_BAG_INTERFACE = 'Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface';

    public const string SYMFONY_STYLE = 'Symfony\Component\Console\Style\SymfonyStyle';

    public const string LOGOUT_EVENT = 'Symfony\Component\Security\Http\Event\LogoutEvent';

    public const string LOGOUT_HANDLER_INTERFACE = 'Symfony\Component\Security\Http\Logout\LogoutHandlerInterface';

    public const string LOGOUT_SUCCESS_HANDLER = 'Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface';

    public const string SYMFONY_VALIDATOR_CONSTRAINTS_COLLECTION = 'Symfony\Component\Validator\Constraints\Collection';

    public const string VALIDATOR_CONSTRAINT = 'Symfony\Component\Validator\Constraint';

    public const string SERVICES_CONFIGURATOR = 'Symfony\Component\DependencyInjection\Loader\Configurator\ServicesConfigurator';

    public const string ARGUMENT_RESOLVER_INTERFACE = 'Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface';

    public const string VALUE_RESOLVER_INTERFACE = 'Symfony\Component\HttpKernel\Controller\ValueResolverInterface';

    public const string VOTER_INTERFACE = 'Symfony\Component\Security\Core\Authorization\Voter\VoterInterface';

    public const string VOTER_CLASS = 'Symfony\Component\Security\Core\Authorization\Voter\Voter';

    public const string VOTE_CLASS = 'Symfony\Component\Security\Core\Authorization\Voter\Vote';

    public const string USER_INTERFACE = 'Symfony\Component\Security\Core\User\UserInterface';

    public const string UUID = 'Symfony\Component\Uid\Uuid';

    public const string ROUTE_COLLECTION_BUILDER = 'Symfony\Component\Routing\RouteCollectionBuilder';

    public const string ROUTING_CONFIGURATOR = 'Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator';

    public const string KERNEL = 'Symfony\Component\HttpKernel\Kernel';

    public const string CONTAINER = 'Symfony\Component\DependencyInjection\Container';

    public const string ABSTRACT_TYPE_EXTENSION = 'Symfony\Component\Form\AbstractTypeExtension';

    public const string ABSTRACT_TYPE = 'Symfony\Component\Form\AbstractType';
}
