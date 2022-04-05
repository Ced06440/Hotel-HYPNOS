<?php

namespace App\Repository;

use App\Entity\BookingMandelieu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BookingMandelieu|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookingMandelieu|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookingMandelieu[]    findAll()
 * @method BookingMandelieu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingMandelieuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BookingMandelieu::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(BookingMandelieu $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(BookingMandelieu $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return BookingMandelieu[] Returns an array of BookingMandelieu objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BookingMandelieu
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
