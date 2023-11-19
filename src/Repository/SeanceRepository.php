<?php

namespace App\Repository;

use App\Entity\Seance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @extends ServiceEntityRepository<Seance>
 *
 * @method Seance|null find($id, $lockMode = null, $lockVersion = null)
 * @method Seance|null findOneBy(array $criteria, array $orderBy = null)
 * @method Seance[]    findAll()
 * @method Seance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SeanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Seance::class);
    }

    /**
     * @return Seance[] Returns an array of Seance objects
     */
    public function findByFilm($film): array
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.film = :val')
            ->setParameter('val', $film)
            ->orderBy('s.dateHeure', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Seance[] Returns an array of Seance objects
     */
    public function findByDate(\DateTimeInterface $date): array
    {
        // Criar o início do dia
        $startOfDay = new \DateTime($date->format('Y-m-d 00:00:00'));

        // Criar o final do dia
        $endOfDay = new \DateTime($date->format('Y-m-d 23:59:59'));

        return $this->createQueryBuilder('s')
            ->andWhere('s.dateHeure BETWEEN :start AND :end')
            ->setParameter('start', $startOfDay)
            ->setParameter('end', $endOfDay)
            ->orderBy('s.dateHeure', 'ASC')
            ->getQuery()
            ->getResult();
    }



    /**
     * @return Seance[] Returns an array of Seance objects
     */
    public function findBySalle($salle): array
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.salle = :val')
            ->setParameter('val', $salle)
            ->orderBy('s.dateHeure', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findSeancesForToday()
    {

        $startOfDay = new \DateTime();
        $startOfDay->setTime(0, 0, 0);


        $endOfDay = new \DateTime();
        $endOfDay->setTime(23, 59, 59);


        $qb = $this->createQueryBuilder('s');
        $qb->where('s.dateHeure BETWEEN :start AND :end')
            ->setParameter('start', $startOfDay)
            ->setParameter('end', $endOfDay)
            ->orderBy('s.dateHeure', 'ASC');

        return $qb->getQuery()->getResult();
    }
}
