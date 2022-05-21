<?php

declare(strict_types=1);

namespace Rector\Symfony\Command;

use Nette\Utils\Json;
use Rector\Symfony\Bridge\Symfony\ContainerServiceProvider;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Webmozart\Assert\Assert;

final class ConvertSymfonyRoutesCommand extends Command
{
    public function __construct(
        private readonly ContainerServiceProvider $containerServiceProvider,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName('convert-symfony-routes');
        $this->setDescription('Convert routes from YAML to resoled controller annotation');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $router = $this->containerServiceProvider->provideByName('router');
        Assert::isInstanceOf($router, 'Symfony\Component\Routing\RouterInterface');

        $routeCollection = $router->getRouteCollection();

        $routes = array_map(
            static fn ($route): array => [
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

        $content = Json::encode($routes, Json::PRETTY) . PHP_EOL;
        $output->write($content, false, OutputInterface::OUTPUT_RAW);

        // @todo invoke the converter

        return Command::SUCCESS;
    }
}
