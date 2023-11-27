<?php

namespace App\Repository;

use App\Entity\ShopPayment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ShopPayment>
 *
 * @method ShopPayment|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShopPayment|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShopPayment[]    findAll()
 * @method ShopPayment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShopPaymentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShopPayment::class);
    }

//    /**
//     * @return ShopPayment[] Returns an array of ShopPayment objects
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

//    public function findOneBySomeField($value): ?ShopPayment
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
