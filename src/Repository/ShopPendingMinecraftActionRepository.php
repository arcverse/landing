<?php

namespace App\Repository;

use App\Entity\ShopPendingMinecraftAction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ShopPendingMinecraftAction>
 *
 * @method ShopPendingMinecraftAction|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShopPendingMinecraftAction|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShopPendingMinecraftAction[]    findAll()
 * @method ShopPendingMinecraftAction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShopPendingMinecraftActionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShopPendingMinecraftAction::class);
    }

//    /**
//     * @return ShopPendingMinecraftAction[] Returns an array of ShopPendingMinecraftAction objects
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

//    public function findOneBySomeField($value): ?ShopPendingMinecraftAction
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
