<?php

declare(strict_types=1);

namespace Rector\Symfony\Helper;

use PhpParser\Node\Attribute;
use PhpParser\Node\AttributeGroup;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use Rector\PhpAttribute\AttributeArrayNameInliner;
use Rector\PhpAttribute\NodeFactory\PhpAttributeGroupFactory;
use Rector\Symfony\DataProvider\ServiceMapProvider;
use Rector\Symfony\ValueObject\ServiceDefinition;

final class MessengerHelper
{
    public const MESSAGE_HANDLER_INTERFACE = 'Symfony\Component\Messenger\Handler\MessageHandlerInterface';

    public const MESSAGE_SUBSCRIBER_INTERFACE = 'Symfony\Component\Messenger\Handler\MessageSubscriberInterface';

    public const AS_MESSAGE_HANDLER_ATTRIBUTE = 'Symfony\Component\Messenger\Attribute\AsMessageHandler';

    private string $messengerTagName = 'messenger.message_handler';

    public function __construct(
        private readonly PhpAttributeGroupFactory $phpAttributeGroupFactory,
        private readonly AttributeArrayNameInliner $attributeArrayNameInliner,
        private readonly ServiceMapProvider $serviceMapProvider,
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function extractOptionsFromServiceDefinition(ServiceDefinition $serviceDefinition): array
    {
        $options = [];
        foreach ($serviceDefinition->getTags() as $tag) {
            if ($this->messengerTagName === $tag->getName()) {
                $options = $tag->getData();
            }
        }
        if ($options['from_transport']) {
            $options['fromTransport'] = $options['from_transport'];
            unset($options['from_transport']);
        }
        return $options;
    }

    /**
     * @return ServiceDefinition[]
     */
    public function getHandlersFromServices(): array
    {
        $serviceMap = $this->serviceMapProvider->provide();
        return $serviceMap->getServicesByTag($this->messengerTagName);
    }

    /**
     * @param array<string, mixed> $options
     */
    public function addAttribute(Class_|ClassMethod $node, array $options = []): Class_|ClassMethod
    {
        $args = $this->phpAttributeGroupFactory->createArgsFromItems($options, self::AS_MESSAGE_HANDLER_ATTRIBUTE);
        $args = $this->attributeArrayNameInliner->inlineArrayToArgs($args);
        $node->attrGroups = array_merge($node->attrGroups, [
            new AttributeGroup([new Attribute(new FullyQualified(self::AS_MESSAGE_HANDLER_ATTRIBUTE), $args)]),
        ]);

        return $node;
    }
}
