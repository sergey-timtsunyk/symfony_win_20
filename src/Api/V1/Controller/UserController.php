<?php

namespace App\Api\V1\Controller;

use App\Entity\User;
use App\Services\Security\PasswordGenerator;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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
     * UserController constructor.
     * @param $passwordGenerator
     */
    public function __construct(PasswordGenerator $passwordGenerator)
    {
        $this->passwordGenerator = $passwordGenerator;
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

        $key = "example_key";
        $payload = array(
            "iss" => "http://example.org",
            "aud" => "http://example.com",
            "iat" => 1356999524,
            "nbf" => 1357000000
        );

        $jwt = JWT::encode($payload, $key);

        return $this->handleView($this->view(
            $requestArray
        , 200));
    }

    private function convertStringToArray(string $str): array
    {
        return json_decode($str, true);
    }
}