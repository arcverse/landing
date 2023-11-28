<?php

namespace App\Repository;

use App\Entity\ShopMinecraftAction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ShopMinecraftAction>
 *
 * @method ShopMinecraftAction|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShopMinecraftAction|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShopMinecraftAction[]    findAll()
 * @method ShopMinecraftAction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShopMinecraftActionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShopMinecraftAction::class);
    }

//    /**
//     * @return ShopMinecraftAction[] Returns an array of ShopMinecraftAction objects
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

//    public function findOneBySomeField($value): ?ShopMinecraftAction
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
