<?php

declare(strict_types=1);

namespace Rector\Symfony\NodeFactory;

use Nette\Utils\Strings;
use PhpParser\Node\Identifier;

final class InvokableControllerNameFactory
{
    public function createControllerName(Identifier $controllerIdentifier, string $actionMethodName): string
    {
        $oldClassName = $controllerIdentifier->toString();

        if (str_starts_with($actionMethodName, 'action')) {
            $actionMethodName = Strings::substring($actionMethodName, strlen('Action'));
        }

        if (str_ends_with($actionMethodName, 'Action')) {
            $actionMethodName = Strings::substring($actionMethodName, 0, -strlen('Action'));
        }

        $actionMethodName = ucfirst($actionMethodName);

        return Strings::replace($oldClassName, '#(.*?)Controller#', '$1' . $actionMethodName . 'Controller');
    }
}
