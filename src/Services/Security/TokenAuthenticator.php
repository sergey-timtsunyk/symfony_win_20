<?php

namespace App\Services\Security;

use App\Repository\UserRepository;
use App\Services\JwtAuth\ExtractPayloadInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class TokenAuthenticator extends AbstractGuardAuthenticator
{
    private const AUTH_HEADER = 'Authorization';

    /**
     * @var UserRepository
     */
    private $userRepository;

    private $extractPayload;

    /**
     * TokenAuthenticator constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository, ExtractPayloadInterface  $extractPayload)
    {
        $this->userRepository = $userRepository;
        $this->extractPayload = $extractPayload;
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        $data = [
            // you might translate this message
            'message' => 'Authentication Required'
        ];

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }

    public function supports(Request $request)
    {
        return $request->headers->has(self::AUTH_HEADER);
    }

    public function getCredentials(Request $request)
    {
        return $request->headers->get(self::AUTH_HEADER);
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $payload = $this->extractPayload->extract($credentials);

        return $this->userRepository->find($payload->getId());
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return true;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $data = [
            // you may want to customize or obfuscate the message first
            'message' => strtr($exception->getMessageKey(), $exception->getMessageData())

            // or to translate this message
            // $this->translator->trans($exception->getMessageKey(), $exception->getMessageData())
        ];

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey)
    {
        return null;
    }

    public function supportsRememberMe()
    {
        return false;
    }
}