<?php

declare(strict_types=1);

namespace Rector\Symfony\NodeAnalyzer;

use PhpParser\Node\Expr\Assign;
use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\New_;
use Rector\Core\Exception\ShouldNotHappenException;
use Rector\Core\PhpParser\Node\BetterNodeFinder;
use Rector\Core\PhpParser\Node\NodeFactory;
use Rector\NodeRemoval\NodeRemover;
use Rector\Symfony\NodeAnalyzer\FormType\CreateFormTypeOptionsArgMover;
use Rector\Symfony\NodeAnalyzer\FormType\FormTypeClassResolver;

final class FormInstanceToFormClassConstFetchConverter
{
    public function __construct(
        private readonly CreateFormTypeOptionsArgMover $createFormTypeOptionsArgMover,
        private readonly NodeFactory $nodeFactory,
        private readonly FormTypeClassResolver $formTypeClassResolver,
        private readonly BetterNodeFinder $betterNodeFinder,
        private readonly NodeRemover $nodeRemover,
    ) {
    }

    public function processNewInstance(MethodCall $methodCall, int $position, int $optionsPosition): ?MethodCall
    {
        $args = $methodCall->getArgs();
        if (! isset($args[$position])) {
            return null;
        }

        $argValue = $args[$position]->value;

        $formClassName = $this->formTypeClassResolver->resolveFromExpr($argValue);
        if ($formClassName === null) {
            return null;
        }

        if ($argValue instanceof New_ && $argValue->args !== []) {
            $methodCall = $this->createFormTypeOptionsArgMover->moveArgumentsToOptions(
                $methodCall,
                $position,
                $optionsPosition,
                $formClassName,
                $argValue->getArgs()
            );
            if (! $methodCall instanceof MethodCall) {
                throw new ShouldNotHappenException();
            }
        } else {
            // some args
            if (! $argValue instanceof ClassConstFetch) {
                $previousAssign = $this->betterNodeFinder->findPreviousAssignToExpr($argValue);
                if ($previousAssign instanceof Assign) {
                    if ($previousAssign->expr instanceof New_) {
                        $previousAssignNew = $previousAssign->expr;

                        // cleanup assign, we don't need it anymore
                        $this->nodeRemover->removeNode($previousAssign);

                        $assignArgs = $previousAssignNew->getArgs();
                        if ($assignArgs !== []) {
                            // turn to 3rd parameter
                            $methodCall = $this->createFormTypeOptionsArgMover->moveArgumentsToOptions(
                                $methodCall,
                                $position,
                                $optionsPosition,
                                $formClassName,
                                $assignArgs
                            );

                            if (! $methodCall instanceof MethodCall) {
                                throw new ShouldNotHappenException();
                            }
                        }
                    }
                }
            }
        }

        $classConstFetch = $this->nodeFactory->createClassConstReference($formClassName);

        $currentArg = $methodCall->getArgs()[$position];
        $currentArg->value = $classConstFetch;

        return $methodCall;
    }
}
