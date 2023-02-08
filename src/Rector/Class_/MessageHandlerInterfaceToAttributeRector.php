<?php

declare(strict_types=1);

namespace Rector\Symfony\Rector\Class_;

use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use Rector\Core\Rector\AbstractRector;
use Rector\Core\ValueObject\PhpVersionFeature;
use Rector\Symfony\Helper\MessengerHelper;
use Rector\VersionBonding\Contract\MinPhpVersionInterface;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see Rector\Symfony\Tests\Rector\Class_\MessageHandlerInterfaceToAttributeRector\MessageHandlerToAttributeRectorTest
 */
final class MessageHandlerInterfaceToAttributeRector extends AbstractRector implements MinPhpVersionInterface
{
    public function __construct(
        private readonly MessengerHelper $messengerHelper,
    ) {
    }

    public function provideMinPhpVersion(): int
    {
        return PhpVersionFeature::ATTRIBUTES;
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Add Symfony\Component\Console\Attribute\AsCommand to Symfony Commands and remove the deprecated properties',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class SmsNotificationHandler implements MessageHandlerInterface
{
    public function __invoke(SmsNotification $message)
    {
        // ... do some work - like sending an SMS message!
    }
}
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class SmsNotificationHandler
{
    public function __invoke(SmsNotification $message)
    {
        // ... do some work - like sending an SMS message!
    }
}
CODE_SAMPLE
                ),

            ]
        );
    }

    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [Class_::class];
    }

    /**
     * @param Class_ $node
     */
    public function refactor(Node $node): ?Node
    {
        if (! $this->hasImplements($node)) {
            return null;
        }

        $this->refactorImplements($node);

        return $this->messengerHelper->addAttribute($node);
    }

    private function hasImplements(Class_ $class): bool
    {
        foreach ($class->implements as $implement) {
            if ($this->isName($implement, MessengerHelper::MESSAGE_HANDLER_INTERFACE)) {
                return true;
            }
        }

        return false;
    }

    private function refactorImplements(Class_ $class): void
    {
        foreach ($class->implements as $key => $implement) {
            if (! $this->isName($implement, MessengerHelper::MESSAGE_HANDLER_INTERFACE)) {
                continue;
            }

            unset($class->implements[$key]);
        }
    }
}
