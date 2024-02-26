<?php

namespace App\Repository;

use App\Entity\Destination;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Destination>
 *
 * @method Destination|null find($id, $lockMode = null, $lockVersion = null)
 * @method Destination|null findOneBy(array $criteria, array $orderBy = null)
 * @method Destination[]    findAll()
 * @method Destination[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DestinationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Destination::class);
    }

    public function paginatonQuery()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.id','ASC')
            ->getQuery()
            ;
    }

    public function findDistinctCountries(): array
    {
        return $this->createQueryBuilder('d')
            ->select('DISTINCT d.pays')
            ->orderBy('d.pays', 'ASC')
            ->getQuery()
            ->getResult();
    }
    public function findAllSortedByCriteria($criteria)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();

        switch ($criteria) {
            case 'ID':
                $orderBy = 'd.id';
                break;
            case 'PAYS':
                $orderBy = 'd.pays';
                break;
            case 'VILLE':
                $orderBy = 'd.ville';
                break;
            case 'ATTRACTIONS':
                $orderBy = 'd.attractions';
                break;
            case 'DEVISE':
                $orderBy = 'd.devise';
                break;
            default:
                $orderBy = 'd.id';
        }

        return $queryBuilder
            ->select('d')
            ->from(Destination::class, 'd')
            ->orderBy($orderBy, 'ASC')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Destination[] Returns an array of Destination objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Destination
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
