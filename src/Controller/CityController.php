<?php

namespace App\Controller;

use App\Controller\Form\CityType;
use App\Entity\City;
use App\Repository\CityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CityController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var CityRepository
     */
    private $cityRepository;

    /**
     * CityController constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager, CityRepository $cityRepository)
    {
        $this->entityManager = $entityManager;
        $this->cityRepository = $cityRepository;
    }

    /**
     * @Route("/city", name="city_list")
     */
    public function list()
    {
        $cities = $this->cityRepository->findAll();

        return $this->render('city/list.html.twig', [
           'cities' =>  $cities,
        ]);
    }

    /**
     * @Route("/city/add", name="city_add")
     */
    public function add(Request $request)
    {
        $form = $this->createForm(CityType::class, new City(), [
            'action' => $this->generateUrl('city_add'),
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $city = $form->getData();
            $this->entityManager->persist($city);
            $this->entityManager->flush();

            return $this->redirectToRoute('city_list');
        }

        if ($form->isSubmitted() && !$form->isValid()) {
            foreach ($form as $fieldName => $formField) {
                // each field has an array of errors
                $this->addFlash('errors.city.add', $formField->getErrors());
            }

            return $this->redirectToRoute('city_list');
        }

        return $this->render('city/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
