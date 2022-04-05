<?php

namespace App\Repository;

use App\Entity\BookingChamonix;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BookingChamonix|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookingChamonix|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookingChamonix[]    findAll()
 * @method BookingChamonix[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingChamonixRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BookingChamonix::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(BookingChamonix $entity, bool $flush = true): void
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
    public function remove(BookingChamonix $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return BookingChamonix[] Returns an array of BookingChamonix objects
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
    public function findOneBySomeField($value): ?BookingChamonix
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
