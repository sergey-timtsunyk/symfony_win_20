<?php

namespace App\Services\Security;

use App\Entity\User;

class PasswordGenerator
{
    private const ALG = 'sha256';

    private $secret;

    public function __construct(string $secret)
    {
        $this->secret = $secret;
    }

    public function generatorHash(string $pass): string
    {
        return hash_hmac(self::ALG, $pass, $this->secret);
    }

    public function checkPass(User $user, string $pass):bool
    {
        return $user->getPassword() === $this->generatorHash($pass);
    }
}