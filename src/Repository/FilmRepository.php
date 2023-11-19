<?php

namespace App\Repository;

use App\Entity\Film;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @extends ServiceEntityRepository<Film>
 *
 * @method Film|null find($id, $lockMode = null, $lockVersion = null)
 * @method Film|null findOneBy(array $criteria, array $orderBy = null)
 * @method Film[]    findAll()
 * @method Film[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilmRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Film::class);
    }

    /**
     * @return Film[] Returns an array of Film objects
     */
    public function findByGenre($genre): array
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.genre = :val')
            ->setParameter('val', $genre)
            ->orderBy('f.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Film[] Returns an array of Film objects
     */
    public function findByRealisateur($realisateur): array
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.realisateur = :val')
            ->setParameter('val', $realisateur)
            ->orderBy('f.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Film|null
     */
    public function findOneByTitre($titre): ?Film
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.titre = :val')
            ->setParameter('val', $titre)
            ->getQuery()
            ->getOneOrNullResult();
    }
    public function findFilmsForTheWeek()
    {
        $qb = $this->createQueryBuilder('f');


        $qb->orderBy('f.id', 'DESC')
            ->setMaxResults(3);

        return $qb->getQuery()->getResult();
    }
}
