<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;


class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function getAllUsers($page, $limit)
    {
        return $this->createQueryBuilder('u')
            ->setMaxResults($limit)
            ->setFirstResult(($page-1) * $limit)
            ->getQuery()
            ->getArrayResult();
    }


    public function deleteAllUsers()
    {
        return $this->createQueryBuilder('u')
            ->delete()
            ->getQuery()
            ->execute();
    }

    public function getSpecificUser($userID)
    {
        return $this->createQueryBuilder('u')
            ->where('u.id = :userid')
            ->setParameter('userid', $userID)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function deleteSpecificUser($userID)
    {
        return $this->createQueryBuilder('u')
            ->delete()
            ->where('u.id = :userid')
            ->setParameter('userid', $userID)
            ->getQuery()
            ->execute();
    }

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
