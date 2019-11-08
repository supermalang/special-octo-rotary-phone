<?php

namespace App\Controller;

use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Workflow\Registry;
use App\Entity\Reservation;
use App\Event\ReservationConfirmedEvent;

class ReservationController extends EasyAdminController
{
    public function __construct(TokenStorageInterface $tokenStorage, Registry $workflows){
        $this->tokenStorage = $tokenStorage;
        $this->user =$this->tokenStorage->getToken()->getUser();
        $this->workflows = $workflows;
    }

    /** Manages the entity creation */
    public function persistEntity($entity){

        /** Set the number of rent days */
        if (method_exists($entity, 'setNumberOfDays')) {
            $rentlength = $entity->getDropoffDate()->diff($entity->getPickupDate())->days;
            $nbofrentdays = round($rentlength / (60 * 60 * 24));
            
            $entity->setNumberOfDays($nbofrentdays);
        }

        /** Set the booking status */
        if (method_exists($entity, 'setStatus')) {
            $entity->setStatus("draft");
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
    
    /** Manages the update of the entity */
    public function updateEntity($entity){
        /** Set the last modified date */
        if (method_exists($entity, 'setModified')) {
            $now = new \DateTime('now');
            $entity->setModified($now);
        }

        /** Set the user who last modified the entity */
        if (method_exists($entity, 'setModifiedby')) {
            $entity->setModifiedby($this->user);
        }

        /** Increment the version history */
        if (method_exists($entity, 'setVersionHistory')) {
            $entity->setVersionHistory($entity->getVersionHistory()+1);
        }
        
        /** Handle the image upload */
        if (method_exists($entity, 'setImageUploadPath')) {
            $uploadPath = $this->propertyMappingFactory->fromField($entity, 'imageFile')->getUriPrefix();

            /** Save the upload path */
            $entity->setImageUploadPath("$uploadPath/");
        }

        parent::updateEntity($entity);
    }

    /** 
     * Run transition from one state to another and redirect to the list view
     * @param string $workflow The workflow that manages the transition
     * @param string $transition Transition fo fire
     */
    public function fireTransition(string $workflow, string $transition){
        $entity = $this->em->getRepository(Reservation::class)->find($this->request->query->get('id'));
        $stateMachine = $this->workflows->get($entity, $workflow, $transition);
    
        if($stateMachine->can($entity, $transition)){ 
            $stateMachine->apply($entity, $transition); 
        }

        $this->updateEntity($entity);
        return $this->redirectToRoute('easyadmin', array( 'action' => 'list', 'entity' => $this->request->query->get('entity'), ));
    }
    
    /** Approve the reservation */
    public function approveAction(){
        return $this->fireTransition('car_reservation', 'approve');
    }
    
    /** Deny the reservation */
    public function denyAction(){
        return $this->fireTransition('car_reservation', 'deny');
    }

    /** Cancel the reservation */
    public function cancelAction(){
        return $this->fireTransition('car_reservation', 'cancel');
    }

    /** Confirm the reservation */
    public function confirmAction(){
        return $this->fireTransition('car_reservation', 'confirm');
    }

    /** Accept the quotation */
    public function acceptquoteAction(){
        return $this->fireTransition('car_reservation', 'approve_quote');
    }
}