<?php

namespace App\Services\Serializer;

class JsonReferenceHandler
{
    public function __invoke($object)
    {
        return $object->getId();
    }
}