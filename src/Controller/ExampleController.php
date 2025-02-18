<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ExampleController extends AbstractController
{
    #[Route('/example/factor/{factor}/divider/{divider}/first/{first}', name: 'app_example')]
    public function index(int $factor, int $divider, int $first): Response
    {
        return $this->render('example/index.html.twig', [
            'factor' => $factor,
            'divider' => $divider,
            'first' => $first,
        ]);
    }
}
