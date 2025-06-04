<?php

namespace Fv\Repository;

use Fv\Entity\Evento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Evento>
 */
class EventoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Evento::class);
    }

    /**
     * @return Evento[] Devuelve todos los eventos públicos (tipo = 'evento')
     */
    public function findEventosPublicos(): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.tipo = :tipo')
            ->setParameter('tipo', 'evento')
            ->orderBy('e.fecha', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Evento[] Devuelve disponibilidad marcada por un usuario
     */
    public function findDisponibilidadPorUsuario(int $usuarioId): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.tipo IN (:tipos)')
            ->andWhere('e.usuario = :usuario')
            ->setParameter('tipos', ['disponible', 'no_disponible'])
            ->setParameter('usuario', $usuarioId)
            ->orderBy('e.fecha', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
