<?php

namespace App\Repository;

use App\Entity\Voluntarios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Voluntarios>
 *
 * @method Voluntarios|null find($id, $lockMode = null, $lockVersion = null)
 * @method Voluntarios|null findOneBy(array $criteria, array $orderBy = null)
 * @method Voluntarios[]    findAll()
 * @method Voluntarios[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoluntariosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Voluntarios::class);
    }

//    /**
//     * @return Voluntarios[] Returns an array of Voluntarios objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Voluntarios
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
