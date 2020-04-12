<?php

namespace App\Services;

interface ServicesGeneratorInterface
{
    public function generatorString(): string;
    public function generatorNumber(): int;
}