<?php

namespace Fv\FantasyVerse\Services\DataTransformers;

use Fv\FantasyVerse\Services\DataTransformers\EntityToArrayInterface;
use Fv\FantasyVerse\Entity\Character;
use Fv\FantasyVerse\Entity\Entity;

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
