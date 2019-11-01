<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use Vich\UploaderBundle\Mapping\PropertyMappingFactory;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class AdminController extends EasyAdminController
{
    public function __construct(PropertyMappingFactory $propertyMappingFactory, TokenStorageInterface $tokenStorage){
        $this->propertyMappingFactory = $propertyMappingFactory;
        $this->tokenStorage = $tokenStorage;
        $this->user =$this->tokenStorage->getToken()->getUser();
    }

    /** Before creating any entity managed by EasyAdmin */
    public function persistEntity($entity){
        /** Set the user who created the entity */
        if (method_exists($entity, 'setCreatedby')) {
            $entity->setCreatedby($this->user);
        }

        parent::persistEntity($entity);
    }
    
    /** Before updating any entity managed by EasyAdmin */
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
            if (method_exists($entity, 'setImageUploadPath')){ $entity->setImageUploadPath("$uploadPath/"); }
        }
        
        parent::updateEntity($entity);
    }

}
