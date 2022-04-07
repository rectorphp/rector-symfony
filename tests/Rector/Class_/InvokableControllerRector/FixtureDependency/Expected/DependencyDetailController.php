<?php

declare(strict_types=1);
namespace Rector\Symfony\Tests\Rector\Class_\InvokableControllerRector\FixtureDependency;

final class DependencyDetailController extends \Symfony\Bundle\FrameworkBundle\Controller\Controller
{
    private const LEFT = 'left';
    private \Rector\Symfony\Tests\Rector\Class_\InvokableControllerRector\Source\NormalRepository $normalRepository;
    private \Rector\Symfony\Tests\Rector\Class_\InvokableControllerRector\Source\LeftRepository $leftRepository;
    public function __construct(\Rector\Symfony\Tests\Rector\Class_\InvokableControllerRector\Source\NormalRepository $normalRepository, \Rector\Symfony\Tests\Rector\Class_\InvokableControllerRector\Source\LeftRepository $leftRepository)
    {
        $this->normalRepository = $normalRepository;
        $this->leftRepository = $leftRepository;
    }
    public function __invoke($id)
    {
        $item = $this->normalRepository->get($id);
        $left = $this->leftRepository->get(self::LEFT);
        return $this->render('detail_path.twig', ['item' => $item, 'left' => $left . $this->left()]);
    }
    private function left()
    {
        return 'left';
    }
}
