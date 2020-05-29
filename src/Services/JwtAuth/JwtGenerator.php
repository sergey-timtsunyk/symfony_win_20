<?php

namespace App\Services\JwtAuth;

use Firebase\JWT\JWT;

class JwtGenerator implements JwtGeneratorInterface
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
        return JWT::encode($payload->getParams(), $this->key);
    }

    public function getPayload(string $token): JwtPayloadInterface
    {
        $payloadArr = JWT::decode($token, $this->key);

        return JwtPayload::getInstance($payloadArr);
    }
}