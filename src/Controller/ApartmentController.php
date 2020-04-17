<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ApartmentController extends AbstractController
{
    /**
     * @Route("/apartment", name="apartment_list")
     */
    public function list()
    {
        return $this->render('apartment/list.html.twig', [
            'controller_name' => 'ApartmentController',
        ]);
    }
}
