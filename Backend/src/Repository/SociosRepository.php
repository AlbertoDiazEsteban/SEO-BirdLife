<?php

namespace App\Repository;

use App\Entity\Socios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Socios>
 *
 * @method Socios|null find($id, $lockMode = null, $lockVersion = null)
 * @method Socios|null findOneBy(array $criteria, array $orderBy = null)
 * @method Socios[]    findAll()
 * @method Socios[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SociosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Socios::class);
    }

//    /**
//     * @return Socios[] Returns an array of Socios objects
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

//    public function findOneBySomeField($value): ?Socios
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
