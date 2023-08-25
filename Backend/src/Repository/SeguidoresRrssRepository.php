<?php

namespace App\Repository;

use App\Entity\SeguidoresRrss;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SeguidoresRrss>
 *
 * @method SeguidoresRrss|null find($id, $lockMode = null, $lockVersion = null)
 * @method SeguidoresRrss|null findOneBy(array $criteria, array $orderBy = null)
 * @method SeguidoresRrss[]    findAll()
 * @method SeguidoresRrss[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SeguidoresRrssRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SeguidoresRrss::class);
    }

//    /**
//     * @return SeguidoresRrss[] Returns an array of SeguidoresRrss objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SeguidoresRrss
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
