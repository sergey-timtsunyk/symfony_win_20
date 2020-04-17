<?php

namespace App\Controller;

use App\Repository\BuildingRepository;
use App\Services\ServicesGeneratorInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    private $buildingRepository;
    private $generator;
    private $logger;

    public function __construct(BuildingRepository $buildingRepository, ServicesGeneratorInterface $generator, LoggerInterface $logger)
    {
        $this->buildingRepository = $buildingRepository;
        $this->generator = $generator;
        $this->logger = $logger;

        $this->logger->debug('generator', ['class' => get_class($generator)]);
    }

    /**
     * @Route("/", name="main")
     */
    public function index()
    {
        $this->buildingRepository->find(1);
        $stringHash = $this->generator->generatorString();

        return $this->render('main/index.html.twig', [
            'stringHash' => $stringHash,
            'controller_name' => 'MainController',
        ]);
    }
}
