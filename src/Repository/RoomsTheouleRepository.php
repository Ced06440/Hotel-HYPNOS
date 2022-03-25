<?php

namespace App\Repository;

use App\Entity\RoomsTheoule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RoomsTheoule|null find($id, $lockMode = null, $lockVersion = null)
 * @method RoomsTheoule|null findOneBy(array $criteria, array $orderBy = null)
 * @method RoomsTheoule[]    findAll()
 * @method RoomsTheoule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoomsTheouleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RoomsTheoule::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(RoomsTheoule $entity, bool $flush = true): void
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
    public function remove(RoomsTheoule $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return RoomsTheoule[] Returns an array of RoomsTheoule objects
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
    public function findOneBySomeField($value): ?RoomsTheoule
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
