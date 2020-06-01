<?php

namespace App\Services\JwtAuth;

interface JwtPayloadInterface
{
    public function getParams(): array;

    public function getId(): int;
}