<?php

namespace App\Services\JwtAuth;

use Firebase\JWT\JWT;

class JwtGenerator implements JwtGeneratorInterface, ExtractPayloadInterface
{


    private $key;

    /**
     * JwtGenerator constructor.
     * @param $key
     */
    public function __construct(string $key)
    {
        $this->key = $key;
    }

    public function generateToken(JwtPayloadInterface $payload): string
    {
        return JWT::encode($payload->getParams(), $this->key, 'HS256');
    }

    public function extract(string $token): JwtPayloadInterface
    {
        $token = trim(substr($token, strlen('Bearer')));

        $payloadArr = JWT::decode($token, $this->key, ['HS256']);

        return JwtPayload::getInstance($payloadArr);
    }
}