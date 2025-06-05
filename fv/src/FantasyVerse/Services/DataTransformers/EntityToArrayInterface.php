<?php

namespace Fv\FantasyVerse\Services\DataTransformers;

use Fv\FantasyVerse\Entity\Entity;

interface EntityToArrayInterface
{
public function transform(Entity $entity): array;
    public function reverse(array $array): Entity;
}
