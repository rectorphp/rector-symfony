<?php

declare(strict_types=1);
namespace Rector\Symfony\Tests\Rector\Class_\InvokableControllerRector\FixtureDependency;

final class DependencyListController extends \Symfony\Bundle\FrameworkBundle\Controller\Controller
{
    private \Rector\Symfony\Tests\Rector\Class_\InvokableControllerRector\Source\NormalRepository $normalRepository;
    public function __construct(\Rector\Symfony\Tests\Rector\Class_\InvokableControllerRector\Source\NormalRepository $normalRepository)
    {
        $this->normalRepository = $normalRepository;
    }
    public function __invoke()
    {
        $item = $this->normalRepository->fetchAll();
        return $this->render('list_path.twig', ['item' => $item]);
    }
}
