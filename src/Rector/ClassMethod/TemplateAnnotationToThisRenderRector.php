<?php

declare(strict_types=1);

namespace Rector\Symfony\Rector\ClassMethod;

use PhpParser\Node;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr;
use PhpParser\Node\Expr\Assign;
use PhpParser\Node\Expr\Closure;
use PhpParser\Node\Expr\Instanceof_;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Function_;
use PhpParser\Node\Stmt\If_;
use PhpParser\Node\Stmt\Return_;
use PhpParser\NodeTraverser;
use PHPStan\Type\ArrayType;
use PHPStan\Type\Constant\ConstantArrayType;
use PHPStan\Type\MixedType;
use PHPStan\Type\ObjectType;
use Rector\BetterPhpDocParser\PhpDoc\DoctrineAnnotationTagValueNode;
use Rector\BetterPhpDocParser\PhpDocManipulator\PhpDocTagRemover;
use Rector\Core\Rector\AbstractRector;
use Rector\Symfony\NodeFactory\ThisRenderFactory;
use Rector\Symfony\TypeAnalyzer\ArrayUnionResponseTypeAnalyzer;
use Rector\Symfony\TypeDeclaration\ReturnTypeDeclarationUpdater;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see https://github.com/symfony/symfony-docs/pull/12387#discussion_r329551967
 * @see https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/view.html
 * @see https://github.com/sensiolabs/SensioFrameworkExtraBundle/issues/641
 *
 * @see \Rector\Symfony\Tests\Rector\ClassMethod\TemplateAnnotationToThisRenderRector\TemplateAnnotationToThisRenderRectorTest
 */
final class TemplateAnnotationToThisRenderRector extends AbstractRector
{
    /**
     * @var class-string
     */
    private const RESPONSE_CLASS = 'Symfony\Component\HttpFoundation\Response';

    public function __construct(
        private readonly ArrayUnionResponseTypeAnalyzer $arrayUnionResponseTypeAnalyzer,
        private readonly ReturnTypeDeclarationUpdater $returnTypeDeclarationUpdater,
        private readonly ThisRenderFactory $thisRenderFactory,
        private readonly PhpDocTagRemover $phpDocTagRemover
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Turns `@Template` annotation to explicit method call in Controller of FrameworkExtraBundle in Symfony',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
/**
 * @Template()
 */
public function indexAction()
{
}
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
public function indexAction()
{
    return $this->render('index.html.twig');
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
        return [ClassMethod::class, Class_::class];
    }

    /**
     * @param Class_|ClassMethod $node
     */
    public function refactor(Node $node): ?Node
    {
        if ($node instanceof Class_) {
            return $this->addAbstractControllerParentClassIfMissing($node);
        }

        return $this->replaceTemplateAnnotation($node);
    }

    private function addAbstractControllerParentClassIfMissing(Class_ $class): ?Class_
    {
        if ($class->extends !== null) {
            return null;
        }

        if (! $this->hasTemplateAnnotations($class)) {
            return null;
        }

        $class->extends = new FullyQualified('Symfony\Bundle\FrameworkBundle\Controller\AbstractController');

        return $class;
    }

    private function replaceTemplateAnnotation(ClassMethod $classMethod): ?Node
    {
        if (! $classMethod->isPublic()) {
            return null;
        }

        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($classMethod);

        $doctrineAnnotationTagValueNode = $phpDocInfo->getByAnnotationClass(
            'Sensio\Bundle\FrameworkExtraBundle\Configuration\Template'
        );
        if (! $doctrineAnnotationTagValueNode instanceof DoctrineAnnotationTagValueNode) {
            return null;
        }

        $this->refactorClassMethod($classMethod, $doctrineAnnotationTagValueNode);

        return $classMethod;
    }

    private function hasTemplateAnnotations(Class_ $class): bool
    {
        foreach ($class->getMethods() as $classMethod) {
            $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($classMethod);
            if ($phpDocInfo->hasByAnnotationClass('Sensio\Bundle\FrameworkExtraBundle\Configuration\Template')) {
                return true;
            }
        }

        return false;
    }

    private function refactorClassMethod(
        ClassMethod $classMethod,
        DoctrineAnnotationTagValueNode $templateDoctrineAnnotationTagValueNode
    ): void {
        /** @var Return_[] $returns */
        $returns = $this->findReturnsInCurrentScope((array) $classMethod->stmts);

        $hasThisRenderOrReturnsResponse = $this->hasLastReturnResponse($classMethod);

        foreach ($returns as $return) {
            $this->refactorReturn(
                $return,
                $classMethod,
                $templateDoctrineAnnotationTagValueNode,
                $hasThisRenderOrReturnsResponse
            );
        }

        if ($returns === []) {
            $thisRenderMethodCall = $this->thisRenderFactory->create(
                $classMethod,
                null,
                $templateDoctrineAnnotationTagValueNode
            );

            $this->refactorNoReturn($classMethod, $thisRenderMethodCall);
        }
    }

    /**
     * This skips anonymous functions and functions, as their returns doesn't influence current code
     *
     * @param Node[] $stmts
     * @return Return_[]
     */
    private function findReturnsInCurrentScope(array $stmts): array
    {
        $returns = [];
        $this->traverseNodesWithCallable($stmts, function (Node $node) use (&$returns): ?int {
            if ($node instanceof Closure) {
                return NodeTraverser::DONT_TRAVERSE_CURRENT_AND_CHILDREN;
            }
            if ($node instanceof Function_) {
                return NodeTraverser::DONT_TRAVERSE_CURRENT_AND_CHILDREN;
            }
            if (! $node instanceof Return_) {
                return null;
            }

            $returns[] = $node;

            return null;
        });

        return $returns;
    }

    private function hasLastReturnResponse(ClassMethod $classMethod): bool
    {
        $lastReturn = $this->betterNodeFinder->findLastInstanceOf((array) $classMethod->stmts, Return_::class);
        if (! $lastReturn instanceof Return_) {
            return false;
        }

        if ($lastReturn->expr === null) {
            return false;
        }

        $responseObjectType = new ObjectType(self::RESPONSE_CLASS);

        $returnType = $this->getType($lastReturn->expr);
        return $responseObjectType->isSuperTypeOf($returnType)
            ->yes();
    }

    private function refactorReturn(
        Return_ $return,
        ClassMethod $classMethod,
        DoctrineAnnotationTagValueNode $templateDoctrineAnnotationTagValueNode,
        bool $hasThisRenderOrReturnsResponse
    ): void {
        // nothing we can do
        if ($return->expr === null) {
            return;
        }

        // create "$this->render('template.file.twig.html', ['key' => 'value']);" method call
        $thisRenderMethodCall = $this->thisRenderFactory->create(
            $classMethod,
            $return,
            $templateDoctrineAnnotationTagValueNode
        );

        $this->refactorReturnWithValue(
            $return,
            $hasThisRenderOrReturnsResponse,
            $thisRenderMethodCall,
            $classMethod
        );
    }

    private function refactorNoReturn(ClassMethod $classMethod, MethodCall $thisRenderMethodCall): void
    {
        $this->processClassMethodWithoutReturn($classMethod, $thisRenderMethodCall);

        $this->returnTypeDeclarationUpdater->updateClassMethod($classMethod, self::RESPONSE_CLASS);

        $this->removeDoctrineAnnotationTagValueNode($classMethod);
    }

    private function refactorReturnWithValue(
        Return_ $return,
        bool $hasThisRenderOrReturnsResponse,
        MethodCall $thisRenderMethodCall,
        ClassMethod $classMethod
    ): void {
        /** @var Expr $lastReturnExpr */
        $lastReturnExpr = $return->expr;

        $returnStaticType = $this->getType($lastReturnExpr);

        if (! $return->expr instanceof MethodCall) {
            if (! $hasThisRenderOrReturnsResponse || $returnStaticType instanceof ConstantArrayType) {
                $return->expr = $thisRenderMethodCall;
            }
        } elseif ($returnStaticType instanceof ArrayType) {
            $return->expr = $thisRenderMethodCall;
        } elseif ($returnStaticType instanceof MixedType) {
            // nothing we can do
            return;
        }

        $isArrayOrResponseType = $this->arrayUnionResponseTypeAnalyzer->isArrayUnionResponseType(
            $returnStaticType,
            self::RESPONSE_CLASS
        );

        if ($isArrayOrResponseType) {
            $this->processIsArrayOrResponseType($return, $lastReturnExpr, $thisRenderMethodCall);
        }

        // already response
        $this->removeAnnotationClass($classMethod);
        $this->returnTypeDeclarationUpdater->updateClassMethod($classMethod, self::RESPONSE_CLASS);
    }

    private function processClassMethodWithoutReturn(
        ClassMethod $classMethod,
        MethodCall $thisRenderMethodCall
    ): void {
        $classMethod->stmts[] = new Return_($thisRenderMethodCall);
    }

    private function processIsArrayOrResponseType(
        Return_ $return,
        Expr $returnExpr,
        MethodCall $thisRenderMethodCall
    ): void {
        $this->removeNode($return);

        // create instance of Response → return response, or return $this->render
        $responseVariable = new Variable('responseOrData');

        $assign = new Assign($responseVariable, $returnExpr);

        $if = new If_(new Instanceof_($responseVariable, new FullyQualified(self::RESPONSE_CLASS)));
        $if->stmts[] = new Return_($responseVariable);

        $thisRenderMethodCall->args[1] = new Arg($responseVariable);

        $returnThisRender = new Return_($thisRenderMethodCall);
        $this->nodesToAddCollector->addNodesAfterNode([$assign, $if, $returnThisRender], $return);
    }

    private function removeDoctrineAnnotationTagValueNode(ClassMethod $classMethod): void
    {
        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($classMethod);

        $doctrineAnnotationTagValueNode = $phpDocInfo->getByAnnotationClass(
            'Sensio\Bundle\FrameworkExtraBundle\Configuration\Template'
        );

        if (! $doctrineAnnotationTagValueNode instanceof DoctrineAnnotationTagValueNode) {
            return;
        }

        $this->phpDocTagRemover->removeTagValueFromNode($phpDocInfo, $doctrineAnnotationTagValueNode);
    }

    private function removeAnnotationClass(ClassMethod $classMethod): void
    {
        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($classMethod);
        $doctrineAnnotationTagValueNode = $phpDocInfo->getByAnnotationClass(
            'Sensio\Bundle\FrameworkExtraBundle\Configuration\Template'
        );

        if ($doctrineAnnotationTagValueNode instanceof DoctrineAnnotationTagValueNode) {
            $this->phpDocTagRemover->removeTagValueFromNode($phpDocInfo, $doctrineAnnotationTagValueNode);
        }
    }
}
