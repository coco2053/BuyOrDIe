<?php

namespace App\Repository;

use App\Entity\ProductProperty;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProductProperty|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductProperty|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductProperty[]    findAll()
 * @method ProductProperty[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductPropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductProperty::class);
    }

    public function findNameBeginWith($value)
    {
        return $this->createQueryBuilder('pp')
            ->andWhere('pp.name LIKE :val')
            ->setParameter('val', ''.$value.'%')
            ->groupBy('pp.name')
            ->orderBy('pp.name', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }
    public function findValueBeginWith($value)
    {
        return $this->createQueryBuilder('pp')
            ->andWhere('pp.value LIKE :val')
            ->setParameter('val', ''.$value.'%')
            ->groupBy('pp.value')
            ->orderBy('pp.value', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return ProductProperty[] Returns an array of ProductProperty objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProductProperty
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
