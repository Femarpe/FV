<?php

namespace Fv\Services\DataTransformers;

use Fv\Entity\Entity;

interface EntityToArrayInterface
{
public function transform(Entity $entity): array;
    public function reverse(array $array): Entity;
}
