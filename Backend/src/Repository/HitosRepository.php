<?php

namespace App\Repository;

use App\Entity\Hitos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Hitos>
 *
 * @method Hitos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hitos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hitos[]    findAll()
 * @method Hitos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HitosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hitos::class);
    }

//    /**
//     * @return Hitos[] Returns an array of Hitos objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('h.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Hitos
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
