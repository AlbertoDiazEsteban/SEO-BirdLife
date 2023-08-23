<?php

namespace App\Repository;

use App\Entity\Resumen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Resumen>
 *
 * @method Resumen|null find($id, $lockMode = null, $lockVersion = null)
 * @method Resumen|null findOneBy(array $criteria, array $orderBy = null)
 * @method Resumen[]    findAll()
 * @method Resumen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResumenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Resumen::class);
    }

//    /**
//     * @return Resumen[] Returns an array of Resumen objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Resumen
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
