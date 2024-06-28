<?php

namespace App\Repository;

use App\Entity\Setdest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Setdest>
 *
 * @method Setdest|null find($id, $lockMode = null, $lockVersion = null)
 * @method Setdest|null findOneBy(array $criteria, array $orderBy = null)
 * @method Setdest[]    findAll()
 * @method Setdest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SetdestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Setdest::class);
    }

    //    /**
    //     * @return Setdest[] Returns an array of Setdest objects
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

    //    public function findOneBySomeField($value): ?Setdest
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function getSetdestdata(): array
    {
        return $this->createQueryBuilder('sd')
            ->select('d.destname, sd.id, sd.price, sd.clientname, sd.status')
            ->join('sd.destid', 'd')
            ->orderBy('sd.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function getSetdestByName($id): array
    {
        return $this->createQueryBuilder('sd')
            ->select('d.destname, sd.id, sd.price, sd.clientname, sd.status, sd.hotelid')
            ->join('sd.destid', 'd')
            ->andWhere('sd.hotelid = :val')
            ->setParameter('val', $id)
            ->andWhere('sd.status = 1')
            ->getQuery()
            ->getResult();
    }
}
