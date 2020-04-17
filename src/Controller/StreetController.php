<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StreetController extends AbstractController
{
    /**
     * @Route("/street", name="street_list")
     */
    public function list()
    {
        return $this->render('street/list.html.twig', [
            'controller_name' => 'StreetController',
        ]);
    }
}
