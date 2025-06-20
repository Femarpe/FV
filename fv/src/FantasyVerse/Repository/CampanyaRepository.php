<?php

namespace Fv\FantasyVerse\Repository;

use Fv\FantasyVerse\Entity\Campanya;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Campanya>
 */
class CampanyaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Campanya::class);
    }

    
}
