<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\ResultSetMapping;


/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }    
    
    public function findUsersBySistema($sistemaId)
    {
        return $this->createQueryBuilder('u')
            ->select('u.id, u.first_name, u.last_name, u.legajo, u.roles')
            ->where('u.sistema = :sistemaId')
            ->andWhere('u.activo = true')
            ->setParameter('sistemaId', $sistemaId)
            ->getQuery()
            ->getResult()
        ;
    }

}
