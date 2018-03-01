<?php

namespace App\Repository;

use App\Entity\Integral;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class IntegralRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Integral::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('i')
            ->where('i.something = :value')->setParameter('value', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
