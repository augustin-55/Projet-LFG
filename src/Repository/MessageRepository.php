<?php

namespace App\Repository;

use App\Entity\Message;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Message|null find($id, $lockMode = null, $lockVersion = null)
 * @method Message|null findOneBy(array $criteria, array $orderBy = null)
 * @method Message[]    findAll()
 * @method Message[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Message::class);
    }

//    /**
//     * @return Message[] Returns an array of Message objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Message
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /*public function findLastMessages($user, $lastId=0)
    {
        $qb = $this->createQueryBuilder('m')
            ->where('m.user = :user')
            ->orWhere('m.distinataire = :user')
            ->setParameter('user', $user);
        
        if ($lastId == 0) {// Premier chargement de la page
            $result = $qb->setMaxResults(5)
             ->setOrder('m.id', 'DESC')
             ->getQuery()
             ->getResult();

            $result = array_reverse($result);

        } else {
            $result = $qb->andWhere('m.id > :lastId')
                ->setParameter('lastId', $lastId)
                ->setOrder('m.id', 'ASC')
                ->getQuery()
                ->getResult();
        }

        return $result;

    }*/

    public function findMessageRecus($user)
    {
        $qb = $this->createQueryBuilder('m')
            ->leftJoin('m.destinataires', 'd')
            ->where('d = :user')
            ->setParameter('user', $user)
            ->setMaxResults(30)
            ->addOrderBy('m.id' ,'DESC')
            ->getQuery()
            ->getResult();
    }
}
