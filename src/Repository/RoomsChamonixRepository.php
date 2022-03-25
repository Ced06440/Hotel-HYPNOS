<?php

namespace App\Repository;

use App\Entity\RoomsChamonix;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RoomsChamonix|null find($id, $lockMode = null, $lockVersion = null)
 * @method RoomsChamonix|null findOneBy(array $criteria, array $orderBy = null)
 * @method RoomsChamonix[]    findAll()
 * @method RoomsChamonix[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoomsChamonixRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RoomsChamonix::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(RoomsChamonix $entity, bool $flush = true): void
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
    public function remove(RoomsChamonix $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return RoomsChamonix[] Returns an array of RoomsChamonix objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RoomsChamonix
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
