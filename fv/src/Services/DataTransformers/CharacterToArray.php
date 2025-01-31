<?php

namespace Fv\Services\DataTransformers;

use Fv\Services\DataTransformers\EntityToArrayInterface;
use Fv\Entity\Character;
use Fv\Entity\Entity;

class CharacterToArray implements EntityToArrayInterface
{
    /**
     * @param Character $character
     */
    public function transform(Entity $character): array
    {
        return [
            'id' => $character->getId(),
            'name' => $character->getName(),
            'health' => $character->getHealth(),
            'ca' => $character->getCa()
        ];
    }

    public function reverse(array $array): Entity
    {
        $character = new Character();

        $character->setId($array['id']);
        $character->setName($array['name']);
        $character->setHealth($array['health']);
        $character->setCa($array['ca']);

        return $character;
    }
}
