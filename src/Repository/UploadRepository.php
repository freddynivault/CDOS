<?php

namespace App\Repository;


use App\Entity\Offer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;



/**
* @method Offer|null find($id, $lockMode = null, $lockVersion = null)
* @method Offer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Offer[]    findAll()
* @method Offer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    */
class UploadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Offer::class);
    }

    // /**
    //  * @return Upload[] Returns an array of Upload objects
    //  */

//    public function findByExampleField($value)
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//            ;
//    }
///
//
///
//    public function findOneBySomeField($value): ?Upload
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//            ;
//    }
//*/
}