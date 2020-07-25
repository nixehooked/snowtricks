<?php

namespace App\Repository;

use App\Entity\Trick;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Trick|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trick|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trick[]    findAll()
 * @method Trick[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrickRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trick::class);
    }

    public function getVisibleTrick(){
        return $this->createQueryBuilder('t')
            ->where('t.is_Active=true')
            ->leftJoin('t.user','u')->addSelect('u')
            ->leftJoin('t.groups','g')->addSelect('g')
            ->leftJoin('t.image','i')->addSelect('i')
            ->leftJoin('t.video','v')->addSelect('v')
            ->orderBy('t.id','DESC')
            ->getQuery()->getResult();
    }
    public function getTrickBySlug($slug){
        return $this->createQueryBuilder('t')
            ->where('t.slug=:slug')->setParameter('slug',$slug)
            ->leftJoin('t.user','u')->addSelect('u')
            ->leftJoin('t.comments', 'c')->addSelect('c')
            ->leftJoin('t.image','i')->addSelect('i')
            ->leftJoin('t.video','v')->addSelect('v')
            ->leftJoin('t.groups','g')->addSelect('g')
            ->getQuery()->getOneOrNullResult();
    }

    // /**
    //  * @return Trick[] Returns an array of Trick objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Trick
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
