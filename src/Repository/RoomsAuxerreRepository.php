<?php

namespace App\Repository;

use App\Entity\RoomsAuxerre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RoomsAuxerre|null find($id, $lockMode = null, $lockVersion = null)
 * @method RoomsAuxerre|null findOneBy(array $criteria, array $orderBy = null)
 * @method RoomsAuxerre[]    findAll()
 * @method RoomsAuxerre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoomsAuxerreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RoomsAuxerre::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(RoomsAuxerre $entity, bool $flush = true): void
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
    public function remove(RoomsAuxerre $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return RoomsAuxerre[] Returns an array of RoomsAuxerre objects
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
    public function findOneBySomeField($value): ?RoomsAuxerre
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
