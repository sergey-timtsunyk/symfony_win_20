<?php

namespace App\Services\JwtAuth;

class JwtPayload implements JwtPayloadInterface
{
    private $userId;
    private $role;

    public function __construct(int $userId, string $role)
    {
        $this->userId = $userId;
        $this->role = $role;
    }

    public static function getInstance(object $params)
    {
        return new self($params->userId, $params->role);
    }

    public function getParams(): array
    {
        return [
            'userId' => $this->userId,
            'role' => $this->role,
        ];
    }
}