<?php

namespace AppBundle\Repository;

/**
 * ParametresRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ParametresRepository extends \Doctrine\ORM\EntityRepository
{
    public function getDernierParametrage(){
        return $this->createQueryBuilder('p')
        ->orderBy('p.id','DESC')
        ->setMaxResults(1)
        ->getQuery()
        ->getOneOrNullResult();
    }
}
