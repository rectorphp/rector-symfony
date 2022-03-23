<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Rector\Class_\InvokableControllerRector\FixtureDependency;

use Rector\Symfony\Tests\Rector\Class_\InvokableControllerRector\Source\NormalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class DependencyController extends Controller
{
    private NormalRepository $normalRepository;

    public function __construct(
        NormalRepository $normalRepository
    ) {
        $this->normalRepository = $normalRepository;
    }

    public function detailAction($id)
    {
        $item = $this->normalRepository->get($id);
        return $this->render('detail_path.twig', ['item' => $item]);
    }

    public function listAction()
    {
        $item = $this->normalRepository->fetchAll();
        return $this->render('list_path.twig', ['item' => $item]);
    }
}
