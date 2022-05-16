<?php

declare(strict_types=1);

namespace Rector\Symfony\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouterInterface;

/**
 * This command must be added to the application to export the routes to work with the "AddRouteAnnotationRector" rule
 */
final class RectorRoutesExportCommand extends Command
{
    protected static $defaultName = 'rector:routes:export';

    public function __construct(private readonly RouterInterface $router)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Displays current routes for an application with resolved controller');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $routeCollection = $this->router->getRouteCollection();

        $routes = array_map(
            static fn (Route $route): array => [
                'path' => $route->getPath(),
                'host' => $route->getHost(),
                'schemes' => $route->getSchemes(),
                'methods' => $route->getMethods(),
                'defaults' => $route->getDefaults(),
                'requirements' => $route->getRequirements(),
                'condition' => $route->getCondition(),
            ],
            $routeCollection->all()
        );

        $content = json_encode($routes, \JSON_PRETTY_PRINT) . "\n";
        $output->write($content, false, OutputInterface::OUTPUT_RAW);

        return Command::SUCCESS;
    }
}
