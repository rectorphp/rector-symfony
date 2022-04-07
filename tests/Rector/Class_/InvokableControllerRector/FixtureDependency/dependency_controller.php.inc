<?php

declare(strict_types=1);

namespace Rector\Symfony\Tests\Rector\Class_\InvokableControllerRector\FixtureDependency;

use Rector\Symfony\Tests\Rector\Class_\InvokableControllerRector\Source\LeftRepository;
use Rector\Symfony\Tests\Rector\Class_\InvokableControllerRector\Source\NormalRepository;
use Rector\Symfony\Tests\Rector\Class_\InvokableControllerRector\Source\RightRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class DependencyController extends Controller
{
    private const LEFT = 'left';

    private const RIGHT = 'right';

    private NormalRepository $normalRepository;

    private LeftRepository $leftRepository;

    private RightRepository $rightRepository;

    public function __construct(
        NormalRepository $normalRepository,
        LeftRepository $leftRepository,
        RightRepository $rightRepository
    ) {
        $this->normalRepository = $normalRepository;
        $this->leftRepository = $leftRepository;
        $this->rightRepository = $rightRepository;
    }

    public function detailAction($id)
    {
        $item = $this->normalRepository->get($id);

        $left = $this->leftRepository->get(self::LEFT);

        return $this->render('detail_path.twig', [
            'item' => $item,
            'left' => $left,
        ]);
    }

    public function listAction()
    {
        $item = $this->normalRepository->fetchAll();

        $right = $this->rightRepository->get(self::RIGHT);

        return $this->render('list_path.twig', [
            'item' => $item,
            'right' => $right,
        ]);
    }
}
