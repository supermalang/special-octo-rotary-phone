<?php

namespace App\EventSubscriber;

use EasyCorp\Bundle\EasyAdminBundle\Event\EasyAdminEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use App\Entity\Reservation;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    private $authorizationChecker;
    public function __construct(TokenStorageInterface $tokenStorage, AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->authorizationChecker = $authorizationChecker;
    }

    public function onEasyAdminPreEdit(GenericEvent $event)
    {
        $entity = $event->getSubject();

        /*if (!($entity instanceof Reservation)) {
            $this->denyEditUnlessSuperOwner();
        }*/

        if ($entity['class'] == Reservation::class) {
            //dump($event);
            //die;
            $this->denyEditUnlessSuperOwner();
        }
    }

    /** Deny the action unless the user is a SUPER_ADMIN or is the owner of the entity */
    public function denyEditUnlessSuperOwner(){
        //$isOwner = 
        /*if (!$this->authorizationChecker->isGranted('ROLE_SUPER_ADMIN') ) {
            throw new AccessDeniedException();
        }*/
    }

    public static function getSubscribedEvents()
    {
        return [
            EasyAdminEvents::PRE_EDIT => 'onEasyAdminPreEdit',
            //'easy_admin.pre_show' => 'onEasyAdminPreShow',
        ];
    }
}
