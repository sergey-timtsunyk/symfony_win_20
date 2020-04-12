<?php

namespace App\Services;

class ServicesGeneratorNew implements ServicesGeneratorInterface
{

    public function generatorString(): string
    {
        return md5(date(DATE_ATOM));
    }

    public function generatorNumber(): int
    {
        return  random_int(0, 99999);
    }
}