<?php

namespace App\Services\JwtAuth;

interface ExtractPayloadInterface
{
    public function extract(string $token): JwtPayloadInterface;
}