<?php

namespace App\Repository;

use App\Entity\Vol;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Vol>
 *
 * @method Vol|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vol|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vol[]    findAll()
 * @method Vol[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VolRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vol::class);
    }

    public function paginatonQuery()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.id','ASC')
            ->getQuery()
            ;
    }
    public function findAllSortedByCriteria($criteria)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();

        switch ($criteria) {
            case 'ID':
                $orderBy = 'v.id';
                break;
            case 'COMPAGNIE':
                $orderBy = 'v.compagnieA';
                break;
            case 'NUM_VOL':
                $orderBy = 'v.num_vol';
                break;
            case 'DEPART':
                $orderBy = 'v.aeroportDepart';
                break;
            case 'ARRIVEE':
                $orderBy = 'v.aeroportArrivee';
                break;
            default:
                $orderBy = 'v.id';
        }

        return $queryBuilder
            ->select('v')
            ->from(Vol::class, 'v')
            ->orderBy($orderBy, 'ASC')
            ->getQuery()
            ->getResult();
    }
    public function findByDateInterval($dateDepart, $dateArrivee)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.dateDepart >= :dateDepart')
            ->andWhere('v.dateArrivee <= :dateArrivee')
            ->setParameter('dateDepart', $dateDepart)
            ->setParameter('dateArrivee', $dateArrivee)
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Vol[] Returns an array of Vol objects
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

//    public function findOneBySomeField($value): ?Vol
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
