<?php

namespace App\Repository;

use App\Entity\Guide;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Guide>
 *
 * @method Guide|null find($id, $lockMode = null, $lockVersion = null)
 * @method Guide|null findOneBy(array $criteria, array $orderBy = null)
 * @method Guide[]    findAll()
 * @method Guide[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GuideRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Guide::class);
    }
    public function findGuideStatistics(): array
    {
        return $this->createQueryBuilder('g')
            ->select(
                'COUNT(g.id) as totalGuides',
                'AVG(g.tarifHoraire) as averageTarif'
            )
            ->getQuery()
            ->getSingleResult();
    }

    public function findGuideStatisticsByCountry(): array
    {
        return $this->createQueryBuilder('g')
            ->select(
                'COUNT(g.id) as totalGuides',
                'AVG(g.tarifHoraire) as averageTarif',
                'g.nationalite as nationality'
            )
            ->groupBy('g.nationalite')
            ->getQuery()
            ->getResult();
    }
    public function findTopFiveGuidesByTours(): array
{
    return $this->createQueryBuilder('g')
        ->select('g.nom', 'g.prenom', 'COUNT(t.id) as numTours')
        ->leftJoin('g.tournees', 't')
        ->groupBy('g.id')
        ->orderBy('numTours', 'DESC')
        ->setMaxResults(5)
        ->getQuery()
        ->getResult();
}


    


//    /**
//     * @return Guide[] Returns an array of Guide objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Guide
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
