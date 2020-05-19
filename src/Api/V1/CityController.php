<?php

namespace App\Api\V1;

use App\Api\Exception\ResponseException;
use App\Entity\City;
use App\Repository\CityRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations\View;

class CityController extends AbstractFOSRestController
{
    /**
     * @var CityRepository
     */
    private $cityRepository;

    /**
     * CityController constructor.
     * @param CityRepository $cityRepository
     */
    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    /**
     * @Route("/city/{id}", name="city_show", methods={"GET"})
     * @ View()
     */
    public function getCityShow(int $id)
    {
        $city = $this->cityRepository->find($id);
        if (!$city instanceof City) {
            throw new ResponseException('Not fount', 404);
        }
        return $city;

        $view = $this->view($city, 200);

        return $this->handleView($view);
    }
}
