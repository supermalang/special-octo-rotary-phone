<?php

namespace App\Repository;

use App\Entity\ReservationContract;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ReservationContract|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReservationContract|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReservationContract[]    findAll()
 * @method ReservationContract[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationContractRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservationContract::class);
    }

    // /**
    //  * @return ReservationContract[] Returns an array of ReservationContract objects
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
    public function findOneBySomeField($value): ?ReservationContract
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
