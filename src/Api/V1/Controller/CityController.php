<?php

namespace App\Api\V1\Controller;

use App\Api\Exception\ResponseException;
use App\Entity\City;
use App\Entity\Street;
use App\Repository\CityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class CityController extends AbstractFOSRestController
{
    /**
     * @var CityRepository
     */
    private $cityRepository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * CityController constructor.
     * @param CityRepository $cityRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(CityRepository $cityRepository, EntityManagerInterface $entityManager)
    {
        $this->cityRepository = $cityRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/city/{id}", name="city_show", methods={"GET"})
     */
    public function getCityShow(City $city)
    {
        return $this->handleView($this->view($city, 200));
    }

    /**
     * @Route("/city", name="city_create", methods={"POST"})
     * @ParamConverter("city", converter="fos_rest.request_body")
     */
    public function addCity(City $city, ConstraintViolationListInterface $validationErrors)
    {
        if ($validationErrors->count()) {
            $data = [];
            /** @var ConstraintViolationInterface $error */
            foreach ($validationErrors as $error) {
                $data[$error->getPropertyPath()] = $error->getMessage();
                return $this->handleView($this->view($data, 400));
            }
        }

        $this->entityManager->persist($city);
        $this->entityManager->flush();

        return $this->handleView($this->view($city, 200));
    }

    /**
     * @Route("/city/{id}", name="city_delete", methods={"DELETE"})
     */
    public function deleteCity(City $city)
    {
        $this->entityManager->remove($city);
        $this->entityManager->flush();

        return $this->handleView($this->view('', 200));
    }

    /**
     * @Route("/street/{id}", name="street_show", methods={"GET"})
     * @ParamConverter(name="street", converter="get_street")
     */
    public function getStreetShow(Street $street)
    {
        $data = [
            'id' => $street->getId(),
            'type' => $street->getType(),
            'name' => $street->getName(),
        ];

        return $this->handleView($this->view($data, 200));
    }
}
