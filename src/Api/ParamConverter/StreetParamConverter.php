<?php

namespace App\Api\ParamConverter;

use App\Repository\CityRepository;
use App\Repository\StreetRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

class StreetParamConverter implements ParamConverterInterface
{
    /**
     * @var StreetRepository
     */
    private $streetRepository;

    /**
     * StreetParamConverter constructor.
     * @param StreetRepository $streetRepository
     */
    public function __construct(StreetRepository $streetRepository)
    {
        $this->streetRepository = $streetRepository;
    }

    public function apply(Request $request, ParamConverter $configuration)
    {
        $id = $request->attributes->get('id');
        $street = $this->streetRepository->find($id);
        $request->attributes->set($configuration->getName(), $street);

        return true;
    }

    public function supports(ParamConverter $configuration)
    {
        return $configuration->getName() === 'street'
            && $configuration->getConverter() === 'get_street';
    }
}