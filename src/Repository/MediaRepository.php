<?php

namespace App\Repository;

use App\Entity\Media;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Media>
 */
class MediaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Media::class);
    }

    /**
     * @param int $limit Le nombre de résultats (par défaut 6)
     * @return Media[] 
     */
    public function findPopular(int $limit = 6): array
    {
        return $this->createQueryBuilder('m')
            ->leftJoin('m.watchHistories', 'wh') 
            ->addSelect('COUNT(wh.id) AS HIDDEN watchCount') 
            ->groupBy('m.id') 
            ->orderBy('watchCount', 'DESC') 
            ->setMaxResults($limit) 
            ->getQuery()
            ->getResult();
    }

    /**
     * @param string $mediaType Le type de média : 'movie' ou 'serie'
     * @param int $limit Le nombre de résultats (par défaut 3)
     * @return Media[] Returns an array of Media objects
     */
    public function findMostPopularMediasByType(string $mediaType, int $limit = 3): array
    {
        $qb = $this->createQueryBuilder('m')
            ->leftJoin('m.watchHistories', 'wh') 
            ->addSelect('COUNT(wh.id) AS HIDDEN watchCount') 
            ->groupBy('m.id')
            ->orderBy('watchCount', 'DESC') 
            ->setMaxResults($limit); 
        
        // Filtrer selon le type de média
        if ($mediaType === 'movie') {
            $qb->andWhere('m INSTANCE OF App\Entity\Movie'); 
        } elseif ($mediaType === 'serie') {
            $qb->andWhere('m INSTANCE OF App\Entity\Serie');
        }

        return $qb->getQuery()->getResult();
    }

    //    /**
    //     * @return Media[] Returns an array of Media objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Media
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
