<?php

namespace App\Repository;

use App\Entity\Bookindorder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Bookindorder>
 *
 * @method Bookindorder|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bookindorder|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bookindorder[]    findAll()
 * @method Bookindorder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookindorderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bookindorder::class);
    }

    //    /**
    //     * @return Bookindorder[] Returns an array of Bookindorder objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Bookindorder
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function getByHotelName($value): array
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.hotel = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findAllDesc(): array
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.status != :val')
            ->setParameter('val', 3)
            ->orderBy('b.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function getMonthlyOrderReport() : array 
    {
        return $this->createQueryBuilder('bo')
            ->select('bo.month, SUM(bo.rent) as totalRent')
            ->andWhere('bo.status = :status')
            ->andWhere('bo.year = :year')
            ->setParameter('status', 0)
            ->setParameter('year', date('Y'))
            ->groupBy('bo.month')
            ->orderBy(
                "CASE bo.month 
                WHEN 'January' THEN 1 
                WHEN 'February' THEN 2 
                WHEN 'March' THEN 3 
                WHEN 'April' THEN 4 
                WHEN 'May' THEN 5 
                WHEN 'June' THEN 6 
                WHEN 'July' THEN 7 
                WHEN 'August' THEN 8 
                WHEN 'September' THEN 9 
                WHEN 'October' THEN 10 
                WHEN 'November' THEN 11 
                WHEN 'December' THEN 12 
                ELSE 0 
            END",
                'ASC'
            )
            ->getQuery()
            ->getResult();
    }

    public function getMonthlyCountRent(): array
    {
        return $this->createQueryBuilder('bo')
            ->select('bo.month, COUNT(bo.rent) as totalRent')
            ->andWhere('bo.status = :status')
            ->andWhere('bo.year = :year')
            ->setParameter('status', 0)
            ->setParameter('year', date('Y'))
            ->groupBy('bo.month')
            ->orderBy(
                "CASE bo.month 
                WHEN 'January' THEN 1 
                WHEN 'February' THEN 2 
                WHEN 'March' THEN 3 
                WHEN 'April' THEN 4 
                WHEN 'May' THEN 5 
                WHEN 'June' THEN 6 
                WHEN 'July' THEN 7 
                WHEN 'August' THEN 8 
                WHEN 'September' THEN 9 
                WHEN 'October' THEN 10 
                WHEN 'November' THEN 11 
                WHEN 'December' THEN 12 
                ELSE 0 
            END",
                'ASC'
            )
            ->getQuery()
            ->getResult();
    }

    public function getClientTotalRent(): array
    {
        return $this->createQueryBuilder('bo')
            ->select('bo.hotel, SUM(bo.rent) as totalRent')
            ->andWhere('bo.year = :year')
            ->setParameter('year', date('Y'))
            ->groupBy('bo.hotel')
            ->getQuery()
            ->getResult();
    }

    public function getClientTotalCount(): array
    {
        return $this->createQueryBuilder('bo')
            ->select('bo.hotel, COUNT(bo.rent) as totalRent')
            ->andWhere('bo.year = :year')
            ->setParameter('year', date('Y'))
            ->groupBy('bo.hotel')
            ->getQuery()
            ->getResult();
    }

    public function totalPendingOrder(): array
    {
        return $this->createQueryBuilder('bo')
            ->select('COUNT(bo.hotel) as totalorder')
            ->andWhere('bo.status = :val')
            ->setParameter('val', 1)
            ->getQuery()
            ->getResult();
    }
}
