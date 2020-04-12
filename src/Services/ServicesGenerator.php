<?php

namespace App\Services;

use Psr\Log\LoggerInterface;

class ServicesGenerator implements ServicesGeneratorInterface
{
    private $logger;

    /**
     * @param mixed $logger
     */
    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }

    public function generatorString(): string
    {
        $this->logger->debug('generatorString', ['string' => 'sha256']);
        return \hash('sha256', date(DATE_ATOM));
    }

    public function generatorNumber(): int
    {
        return \random_int(0, PHP_INT_MAX);
    }
}