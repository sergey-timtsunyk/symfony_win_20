<?php

namespace App\Api\V1\Controller;

use App\Entity\User;
use App\Services\JwtAuth\JwtGenerator;
use App\Services\JwtAuth\JwtGeneratorInterface;
use App\Services\JwtAuth\JwtPayload;
use App\Services\Security\PasswordGenerator;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class UserController extends AbstractFOSRestController
{
    /**
     * @var PasswordGenerator
     */
    private $passwordGenerator;

    /**
     * @var JwtGeneratorInterface
     */
    private $jwtGenerator;

    /**
     * UserController constructor.
     * @param PasswordGenerator $passwordGenerator
     * @param JwtGeneratorInterface $jwtGenerator
     */
    public function __construct(PasswordGenerator $passwordGenerator, JwtGeneratorInterface $jwtGenerator)
    {
        $this->passwordGenerator = $passwordGenerator;
        $this->jwtGenerator = $jwtGenerator;
    }

    /**
     * @Route("/users/{id}/token", name="user_token", methods={"POST"})
     */
    public function getToken(User $user, Request $request)
    {
        $requestArray = $this->convertStringToArray($request->getContent());
        $pass = $requestArray['pass'];

        if ($user->getEmail() !== $requestArray['email']
            && !$this->passwordGenerator->checkPass($user, $pass)
        ) {
            throw new AuthenticationException('Credentials not validated');
        }

        $jwt =  $this->jwtGenerator->generateToken(new JwtPayload($user->getId(),  $user->getRoles()));

        return $this->handleView($this->view(
            $jwt
        , 200));
    }

    private function convertStringToArray(string $str): array
    {
        return json_decode($str, true);
    }
}