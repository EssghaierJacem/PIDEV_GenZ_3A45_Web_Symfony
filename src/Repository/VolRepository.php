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
    public function findByCriteria($criteria)
    {
        $queryBuilder = $this->createQueryBuilder('v');

        if ($criteria['compagnieA']) {
            $queryBuilder->andWhere('v.compagnieA LIKE :compagnieA')
                ->setParameter('compagnieA', '%' . $criteria['compagnieA'] . '%');
        }

        if ($criteria['num_vol']) {
            $queryBuilder->andWhere('v.num_vol = :num_vol')
                ->setParameter('num_vol', $criteria['num_vol']);
        }

        if ($criteria['aeroportDepart']) {
            $queryBuilder->andWhere('v.aeroportDepart LIKE :aeroportDepart')
                ->setParameter('aeroportDepart', '%' . $criteria['aeroportDepart'] . '%');
        }

        if ($criteria['aeroportArrivee']) {
            $queryBuilder->andWhere('v.aeroportArrivee LIKE :aeroportArrivee')
                ->setParameter('aeroportArrivee', '%' . $criteria['aeroportArrivee'] . '%');
        }

        if ($criteria['tarif']) {
            $queryBuilder->andWhere('v.tarif = :tarif')
                ->setParameter('tarif', $criteria['tarif']);
        }

        if (isset($criteria['escale'])) {
            if ($criteria['escale'] === 'avec') {
                $queryBuilder->andWhere('v.escale IS NOT NULL');
            } elseif ($criteria['escale'] === 'sans') {
                $queryBuilder->andWhere('v.escale IS NULL');
            }
        }

        if ($criteria['classe']) {
            $queryBuilder->andWhere('v.classe = :classe')
                ->setParameter('classe', $criteria['classe']);
        }

        if ($criteria['destination']) {
            $queryBuilder->andWhere('v.destination = :destination')
                ->setParameter('destination', $criteria['destination']);
        }

        // Handle date interval search
        if ($criteria['dateDepart'] && $criteria['dateArrivee']) {
            $queryBuilder->andWhere('v.dateDepart >= :dateDepart')
                ->andWhere('v.dateArrivee <= :dateArrivee')
                ->setParameter('dateDepart', $criteria['dateDepart'])
                ->setParameter('dateArrivee', $criteria['dateArrivee']);
        }

        // Execute the query
        $query = $queryBuilder->getQuery();

        // Return the filtered results
        return $query->getResult();
    }


    /**
     *
     * @param int $limit
     * @return array
     */
    public function findTopCompanies(int $limit): array
    {
        return $this->createQueryBuilder('v')
            ->select('v.compagnieA as compagnieA, SUM(v.tarif) as totalRevenue')
            ->groupBy('v.compagnieA')
            ->orderBy('totalRevenue', 'DESC')
            ->setMaxResults($limit)
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
