<?php

namespace Fv\Controller;

use Exception;
use Fv\Repository\CharacterRepository;
use Fv\Services\DataTransformers\CharacterToArray;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetCharactersJSONController extends AbstractController
{
    public function __invoke(
        CharacterRepository $repository,
        CharacterToArray $characterToArray
    ): Response {
        try {
            $characters = $repository->findAll();

            $jsonCharacters = [];
            foreach($characters as $character) {
                $jsonCharacters[] = $characterToArray->transform($character);
            }
    
            return new JsonResponse($jsonCharacters);
        } catch (Exception $e) {
            return new JsonResponse(null, 500);
        }
    }
}