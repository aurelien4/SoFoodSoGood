<?php

namespace AppBundle\Repository;

/**
 * DrinkRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DrinkRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllByJoinedIdBar($id){
        $query = $this->getEntityManager()
            ->createQuery(
                "SELECT d.id, d.name, d.degree, d.liter , d.price
                FROM AppBundle:Drink d
                JOIN d.type t
                WHERE d.type = t.id
                AND t.id = :id"
            )->setParameter("id", $id);

        try{
            return $query->getArrayResult();
        } catch (\Doctrine\ORM\NoResultException $e){
            return null;
        }
    }
}
