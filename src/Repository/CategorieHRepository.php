<?php

namespace App\Repository;

use App\Entity\CategorieH;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CategorieH>
 *
 * @method CategorieH|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieH|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieH[]    findAll()
 * @method CategorieH[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieHRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieH::class);
    }

//    /**
//     * @return CategorieH[] Returns an array of CategorieH objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CategorieH
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
