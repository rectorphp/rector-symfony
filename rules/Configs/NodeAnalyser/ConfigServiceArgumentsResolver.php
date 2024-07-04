<?php

declare(strict_types=1);

namespace Rector\Symfony\Configs\NodeAnalyser;

use PhpParser\NodeTraverser;
use Rector\PhpParser\Parser\SimplePhpParser;
use Rector\Symfony\Configs\NodeVisitor\CollectServiceArgumentsNodeVisitor;
use Rector\Symfony\Configs\ValueObject\ServiceArguments;
use Symfony\Component\Finder\SplFileInfo;

final class ConfigServiceArgumentsResolver
{
    private NodeTraverser $nodeTraverser;

    private CollectServiceArgumentsNodeVisitor $collectServiceArgumentsNodeVisitor;

    public function __construct(
        private readonly SimplePhpParser $simplePhpParser
    ) {
        $this->nodeTraverser = new NodeTraverser();
        $this->collectServiceArgumentsNodeVisitor = new CollectServiceArgumentsNodeVisitor();
        $this->nodeTraverser->addVisitor($this->collectServiceArgumentsNodeVisitor);
    }

    /**
     * @param SplFileInfo[] $phpConfigFileInfos
     * @return ServiceArguments[]
     */
    public function resolve(array $phpConfigFileInfos): array
    {
        $servicesArguments = [];

        foreach ($phpConfigFileInfos as $phpConfigFileInfo) {
            // traverse and collect data
            $configStmts = $this->simplePhpParser->parseString($phpConfigFileInfo->getContents());
            $this->nodeTraverser->traverse($configStmts);

            $servicesArguments = array_merge(
                $servicesArguments,
                $this->collectServiceArgumentsNodeVisitor->getServicesArguments()
            );
        }

        return $servicesArguments;
    }
}
