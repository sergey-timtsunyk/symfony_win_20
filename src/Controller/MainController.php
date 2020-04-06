<?php

namespace App\Controller;

use App\Repository\BuildingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    private $buildingRepository;

    public function __construct(BuildingRepository $buildingRepository)
    {
        $this->buildingRepository = $buildingRepository;
    }

    /**
     * @Route("/main", name="main")
     */
    public function index()
    {
        var_dump($this->container);

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}
