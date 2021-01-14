<?php

namespace App\Repository;

use App\Entity\SendTo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SendTo|null find($id, $lockMode = null, $lockVersion = null)
 * @method SendTo|null findOneBy(array $criteria, array $orderBy = null)
 * @method SendTo[]    findAll()
 * @method SendTo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SendToRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SendTo::class);
    }

    // /**
    //  * @return SendTo[] Returns an array of SendTo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SendTo
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
