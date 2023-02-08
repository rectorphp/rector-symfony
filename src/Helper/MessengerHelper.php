<?php

declare(strict_types=1);

namespace Rector\Symfony\Helper;

use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use Rector\PhpAttribute\NodeFactory\PhpAttributeGroupFactory;

final class MessengerHelper
{
    public const MESSAGE_HANDLER_INTERFACE = 'Symfony\Component\Messenger\Handler\MessageHandlerInterface';

    private const AS_MESSAGE_HANDLER_ATTRIBUTE = 'Symfony\Component\Messenger\Attribute\AsMessageHandler';

    public function __construct(
        private readonly PhpAttributeGroupFactory $phpAttributeGroupFactory,
    ) {
    }

    /**
     * @param array<string, mixed> $options
     */
    public function addAttribute(Class_|ClassMethod $node, array $options = []): Class_|ClassMethod
    {
        $node->attrGroups = [
            $this->phpAttributeGroupFactory->createFromClassWithItems(self::AS_MESSAGE_HANDLER_ATTRIBUTE, $options),
        ];

        return $node;
    }
}
