<?php

namespace App\Repository;

use App\Entity\ReservationOption;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ReservationOption|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReservationOption|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReservationOption[]    findAll()
 * @method ReservationOption[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationOptionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservationOption::class);
    }

    // /**
    //  * @return ReservationOption[] Returns an array of ReservationOption objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ReservationOption
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
