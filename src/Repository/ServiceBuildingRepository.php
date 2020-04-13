<?php

namespace App\Repository;

use App\Entity\ServiceBuilding;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ServiceBuilding|null find($id, $lockMode = null, $lockVersion = null)
 * @method ServiceBuilding|null findOneBy(array $criteria, array $orderBy = null)
 * @method ServiceBuilding[]    findAll()
 * @method ServiceBuilding[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServiceBuildingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ServiceBuilding::class);
    }

    // /**
    //  * @return ServiceBuilding[] Returns an array of ServiceBuilding objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ServiceBuilding
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
