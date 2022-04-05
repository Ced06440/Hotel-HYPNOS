<?php

namespace App\Repository;

use App\Entity\BookingTheoule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BookingTheoule|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookingTheoule|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookingTheoule[]    findAll()
 * @method BookingTheoule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingTheouleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BookingTheoule::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(BookingTheoule $entity, bool $flush = true): void
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
    public function remove(BookingTheoule $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return BookingTheoule[] Returns an array of BookingTheoule objects
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
    public function findOneBySomeField($value): ?BookingTheoule
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
