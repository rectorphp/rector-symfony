<?php

declare(strict_types=1);

namespace Rector\Symfony\NodeAnalyzer;

use PhpParser\Node\Expr;
use PhpParser\Node\Expr\Assign;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Expr\Variable;
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

        $formNew = $this->resolveFormNew($argValue);

        if ($formNew instanceof New_ && $formNew->getArgs() !== []) {
            $methodCall = $this->createFormTypeOptionsArgMover->moveArgumentsToOptions(
                $methodCall,
                $position,
                $optionsPosition,
                $formClassName,
                $formNew->getArgs()
            );
            if (! $methodCall instanceof MethodCall) {
                throw new ShouldNotHappenException();
            }
        }

        // remove previous assign
        $previousAssign = $this->betterNodeFinder->findPreviousAssignToExpr($argValue);
        if ($previousAssign instanceof Assign) {
            $this->nodeRemover->removeNode($previousAssign);
        }

        $classConstFetch = $this->nodeFactory->createClassConstReference($formClassName);

        $currentArg = $methodCall->getArgs()[$position];
        $currentArg->value = $classConstFetch;

        return $methodCall;
    }

    private function resolveFormNew(Expr $expr): ?New_
    {
        if ($expr instanceof New_) {
            return $expr;
        }

        if ($expr instanceof Variable) {
            $previousAssign = $this->betterNodeFinder->findPreviousAssignToExpr($expr);
            if (! $previousAssign instanceof Assign) {
                return null;
            }

            if ($previousAssign->expr instanceof New_) {
                return $previousAssign->expr;
            }
        }

        return null;
    }
}
