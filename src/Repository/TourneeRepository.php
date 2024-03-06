<?php

namespace App\Repository;

use App\Entity\Tournee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tournee>
 *
 * @method Tournee|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tournee|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tournee[]    findAll()
 * @method Tournee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TourneeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tournee::class);
    }
    public function paginatonQuery()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.id','ASC')
            ->getQuery()
            ;
    }
    public function findByCriteria($criteria)
{
    $queryBuilder = $this->createQueryBuilder('t');

    // Construisez la requête en fonction des critères fournis
    if ($criteria['nom']) {
        $queryBuilder->andWhere('t.nom LIKE :nom')
                     ->setParameter('nom', '%'.$criteria['nom'].'%');
    }

    if ($criteria['dateDebut']) {
        $queryBuilder->andWhere('t.dateDebut = :dateDebut')
                     ->setParameter('dateDebut', $criteria['dateDebut']);
    }

    if ($criteria['duree']) {
        $queryBuilder->andWhere('t.duree = :duree')
                     ->setParameter('duree', $criteria['duree']);
    }
    if ($criteria['tarif']) {
        $queryBuilder->andWhere('t.tarif = :tarif')
                     ->setParameter('tarif', $criteria['tarif']);
    }

    // Exécutez la requête
    $query = $queryBuilder->getQuery();

    // Retournez les résultats filtrés
    return $query->getResult();
}

public function findAllSorted($sortField, $sortOrder): array
    {
        return $this->createQueryBuilder('t')
            ->orderBy('t.' . $sortField, $sortOrder)
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Tournee[] Returns an array of Tournee objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Tournee
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
