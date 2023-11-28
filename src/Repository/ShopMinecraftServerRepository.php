<?php

namespace App\Repository;

use App\Entity\ShopMinecraftServer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ShopMinecraftServer>
 *
 * @method ShopMinecraftServer|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShopMinecraftServer|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShopMinecraftServer[]    findAll()
 * @method ShopMinecraftServer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShopMinecraftServerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShopMinecraftServer::class);
    }

//    /**
//     * @return ShopMinecraftServer[] Returns an array of ShopMinecraftServer objects
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

//    public function findOneBySomeField($value): ?ShopMinecraftServer
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
