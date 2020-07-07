<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function findBrandBeginWith($value)
    {
        return $this->createQueryBuilder('p')
            ->where('p.brand LIKE :val')
            ->setParameter('val', ''.$value.'%')
            ->orderBy('p.brand', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findAllBrands()
    {
        return $this->createQueryBuilder('p')
            ->select('p.brand')
            ->orderBy('p.brand', 'ASC')
            ->groupBy('p.brand')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByCategory($category)
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.category', 'pc')
            ->where('pc.name LIKE :val')
            ->setParameter('val', $category)
            ->getQuery()
            ->getResult()
            ;
    }

    public function filter($data)
    {
        $qb = $this->createQueryBuilder('p');
        if($data['category'] != 'null') {
            $qb->leftJoin('p.category', 'pc')
                ->andWhere('pc.name LIKE :val')
                ->setParameter('val', $data['category'])
                ;
        }
        if($data['brand'] != 'null') {
            $qb->andWhere('p.brand LIKE :val2')
                ->setParameter('val2', $data['brand'])
            ;
        }
        return$qb->getQuery()
            ->getResult()
            ;
    }
    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
