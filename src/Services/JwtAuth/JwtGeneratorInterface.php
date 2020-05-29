<?php

namespace App\Services\JwtAuth;

interface JwtGeneratorInterface
{
    public function generateToken(JwtPayload $payload): string;
}