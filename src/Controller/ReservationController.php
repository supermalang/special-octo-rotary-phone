<?php

namespace App\Controller;

use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ReservationController extends EasyAdminController
{
    public function __construct(TokenStorageInterface $tokenStorage){
        $this->tokenStorage = $tokenStorage;
        $this->user =$this->tokenStorage->getToken()->getUser();
    }

    public function persistEntity($entity){

        /** Set the number of rent days */
        if (method_exists($entity, 'setNumberOfDays')) {
            $rentlength = $entity->getDropoffDate()->diff($entity->getPickupDate())->days;
            $nbofrentdays = round($rentlength / (60 * 60 * 24));
            
            $entity->setNumberOfDays($nbofrentdays);
        }

        /** Set the booking status */
        if (method_exists($entity, 'setStatus')) {
            $entity->setStatus("Draft");
        }

        /** Set the user who created the entity */
        if (method_exists($entity, 'setCreatedby')) {
            $entity->setCreatedby($this->user);
        }
        
        /** Set the entity creation date */
        if (method_exists($entity, 'setCreated')) {
            $now = new \DateTimeImmutable();
            $entity->setCreated($now);
        }

        parent::persistEntity($entity);
    }
}