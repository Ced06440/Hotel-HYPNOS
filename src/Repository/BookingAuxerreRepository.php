<?php

namespace App\Repository;

use App\Entity\BookingAuxerre;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Query\Expr\Select;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Mapping\Id;

/**
 * @method BookingAuxerre|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookingAuxerre|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookingAuxerre[]    findAll()
 * @method BookingAuxerre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingAuxerreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BookingAuxerre::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(BookingAuxerre $entity, bool $flush = true): void
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
    public function remove(BookingAuxerre $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }


    // /**
    //  * @return BookingAuxerre[] Returns an array of BookingAuxerre objects
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
    public function findOneBySomeField($value): ?BookingAuxerre
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
