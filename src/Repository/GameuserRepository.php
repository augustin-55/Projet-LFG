<?php

namespace App\Repository;

use App\Entity\Gameuser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Gameuser|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gameuser|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gameuser[]    findAll()
 * @method Gameuser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameuserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Gameuser::class);
    }

//    /**
//     * @return Gameuser[] Returns an array of Gameuser objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Gameuser
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
