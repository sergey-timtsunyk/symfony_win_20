<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BuildingController extends AbstractController
{
    /**
     * @Route("/building", name="building_list")
     */
    public function list()
    {
        return $this->render('building/list.html.twig', [
            'controller_name' => 'BuildingController',
        ]);
    }
}
