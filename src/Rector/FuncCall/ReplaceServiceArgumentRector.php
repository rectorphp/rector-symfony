<?php

declare(strict_types=1);

namespace Rector\Symfony\Rector\FuncCall;

use PhpParser\Node;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Scalar\String_;
use Rector\Core\Contract\Rector\ConfigurableRectorInterface;
use Rector\Core\Rector\AbstractRector;
use Rector\Symfony\ValueObject\ReplaceServiceArgument;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\ConfiguredCodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
use Webmozart\Assert\Assert;

final class ReplaceServiceArgumentRector extends AbstractRector implements ConfigurableRectorInterface
{
    /**
     * @var ReplaceServiceArgument[]
     */
    private array $replaceServiceArguments = [];

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Replace defined service() argument in Symfony PHP config',
            [
                new ConfiguredCodeSample(
                    <<<'CODE_SAMPLE'
use Symfony\Component\DependencyInjection\Loader\Configurator\service;

return service(ContainerInterface::class);
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
use Symfony\Component\DependencyInjection\Loader\Configurator\service;

return service('service_container');
CODE_SAMPLE
                    ,
                    [new ReplaceServiceArgument('ContainerInterface', new String_('service_container'))]
                ),
            ]
        );
    }

    /**
     * @return array<class-string<\PhpParser\Node>>
     */
    public function getNodeTypes(): array
    {
        return [FuncCall::class];
    }

    /**
     * @param FuncCall $node
     */
    public function refactor(Node $node)
    {
        if (! $this->isName($node, 'Symfony\Component\DependencyInjection\Loader\Configurator\service')) {
            return null;
        }

        dump('__');
        die;
    }

    /**
     * @param mixed[] $configuration
     */
    public function configure(array $configuration): void
    {
        Assert::allIsAOf($configuration, ReplaceServiceArgument::class);
        $this->replaceServiceArguments = $configuration;
    }
}
