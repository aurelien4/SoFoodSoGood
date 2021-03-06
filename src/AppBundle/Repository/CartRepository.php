<?php

namespace AppBundle\Repository;

/**
 * CartRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CartRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByIdsJoinedUser($id){
        $query = $this->getEntityManager()
            ->createQuery(
                "SELECT  u,cc,i.id, i.itemName, i.itemPrice
                FROM AppBundle:Cart cc
                JOIN cc.items i
                JOIN i.category ca
                JOIN cc.user u
                WHERE cc.user = u.id
                AND ca.id = i.category
                AND u.id = :id
                AND cc.endPurchase = 0 "
            )->setParameter("id",$id);
        try{
            return $query->getArrayResult();
        }catch (\Doctrine\ORM\NoResultException $e){
            return null;
        }
    }
    public function findByIdJoinedUser($id){
        $query = $this->getEntityManager()
            ->createQuery(
                "SELECT  u,cc,i.id, i.itemName, i.itemPrice
                FROM AppBundle:Cart cc
                JOIN cc.items i
                JOIN i.category ca
                JOIN cc.user u
                WHERE cc.user = u.id
                AND ca.id = i.category
                AND u.id = :id"
            )->setParameter("id",$id);
        try{
            return $query->getSingleResult();
        }catch (\Doctrine\ORM\NoResultException $e){
            return null;
        }
    }
    public function findAllJoinedByUser(){
        $query = $this->getEntityManager()
            ->createQuery(
                "SELECT u,cc,i
                FROM AppBundle:Cart cc
                JOIN cc.items i
                JOIN i.category ca
                JOIN cc.user u
                WHERE cc.user = u.id
                AND ca.id = i.category
                AND cc.endPurchase = 0"
            );
        try{
            return $query->getArrayResult();
        }catch (\Doctrine\ORM\NoResultException $e){
            return null;
        }
    }
    public function findAllJoinedByUserValid(){
        $query = $this->getEntityManager()
            ->createQuery(
                "SELECT u,cc,i
                FROM AppBundle:Cart cc 
                JOIN cc.items i
                JOIN i.category ca
                JOIN cc.user u 
                WHERE cc.user = u.id
                AND ca.id = i.category
                AND cc.endPurchase = 1"
            );
        try{
            return $query->getArrayResult();
        }catch(\Doctrine\ORM\NoResultException $e){
            return null;
        }
    }
}

