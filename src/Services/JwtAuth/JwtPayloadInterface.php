<?php

namespace App\Services\JwtAuth;

interface JwtPayloadInterface
{
    public function getParams(): array;
}