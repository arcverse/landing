<?php

namespace App\Repository;

use App\Entity\ShopSoldItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ShopSoldItem>
 *
 * @method ShopSoldItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShopSoldItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShopSoldItem[]    findAll()
 * @method ShopSoldItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShopSoldItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShopSoldItem::class);
    }

//    /**
//     * @return ShopSoldItem[] Returns an array of ShopSoldItem objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ShopSoldItem
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
