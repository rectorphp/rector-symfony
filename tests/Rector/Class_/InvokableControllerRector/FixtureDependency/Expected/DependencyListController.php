<?php

declare(strict_types=1);
namespace Rector\Symfony\Tests\Rector\Class_\InvokableControllerRector\FixtureDependency;

final class DependencyListController extends \Symfony\Bundle\FrameworkBundle\Controller\Controller
{
    private const RIGHT = 'right';
    private \Rector\Symfony\Tests\Rector\Class_\InvokableControllerRector\Source\NormalRepository $normalRepository;
    private \Rector\Symfony\Tests\Rector\Class_\InvokableControllerRector\Source\RightRepository $rightRepository;
    public function __construct(\Rector\Symfony\Tests\Rector\Class_\InvokableControllerRector\Source\NormalRepository $normalRepository, \Rector\Symfony\Tests\Rector\Class_\InvokableControllerRector\Source\RightRepository $rightRepository)
    {
        $this->normalRepository = $normalRepository;
        $this->rightRepository = $rightRepository;
    }
    public function __invoke()
    {
        $item = $this->normalRepository->fetchAll();
        $right = $this->rightRepository->get(self::RIGHT);
        return $this->render('list_path.twig', ['item' => $item, 'right' => $right]);
    }
}
