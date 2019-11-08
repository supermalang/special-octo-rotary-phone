<?php
namespace App\Subscriber;

use Symfony\Component\Mime\Email;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Workflow\Workflow;
use Symfony\Component\Workflow\Event\TransitionEvent;
use Symfony\Component\Workflow\Event\EnteredEvent;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;
use Doctrine\ORM\EntityManagerInterface;
use App\Event\ReservationConfirmedEvent;
use App\Entity\ReservationContract;
use Psr\Log\LoggerInterface;

class ReservationSubscriber implements EventSubscriberInterface{
    const WF_NAME = 'car_reservation';
    public function __construct(LoggerInterface $logger, EntityManagerInterface $em, Workflow $wf){
        $this->workflow = $wf;
        $this->logger =$logger;
        $this->em = $em;
    }
    
    public static function getSubscribedEvents(){
        return array(
            'workflow.car_reservation.entered.confirmed' => array( array('system_fire_SendQuote', 10) ),
            'workflow.car_reservation.transition.system_send_quote' => array( array('sendQuote', 10) ),
            'workflow.car_reservation.entered.quote_accepted' => array( array('system_fire_CreateContract', 10) ),
            'workflow.car_reservation.transition.system_process_contract' => array( array('onQuotationApproved', 10) ),
        );
    }

    /** When the reservation is confirmed we create a contract and send it to the customer */
    public function onQuotationApproved(TransitionEvent $event){
        $contract = new ReservationContract();
        $reservation = $event->getSubject();
        $contract->setCustomer($reservation->getCustomer());
        $contract->setReservation($reservation);
        
        $this->em->persist($contract);
        $this->em->flush();
    }
    
    /** Fires the system_send_quote transition */
    public function system_fire_SendQuote(EnteredEvent $event){
        if ($this->workflow->can($event->getSubject(), 'system_send_quote')) {
            $this->workflow->apply($event->getSubject(), 'system_send_quote');
            $this->em->flush();
        }
    }

    /** Fires the system_process_contract transition */
    public function system_fire_CreateContract(EnteredEvent $event){
        if ($this->workflow->can($event->getSubject(), 'system_process_contract')) {
            $this->workflow->apply($event->getSubject(), 'system_process_contract');
            $this->em->flush();
        }
    }

    public function sendQuote(TransitionEvent $event){
        $transport = (new EsmtpTransport('smtp.office365.com', 587, 'tls'))->setUsername('md@elhadjmalang.com')->setPassword('mB@rkham91!');
        $mailer = new Mailer($transport);
        $customer = $event->getSubject()->getCustomer();
        $resrv_id = $event->getSubject()->getId();

        $email = (new Email())
            ->from('md@elhadjmalang.com')
            ->to($customer->getEmail())
            ->cc('e.diedhiou@gmail.com')
            ->replyTo('md@elhadjmalang.com')
            ->priority(Email::PRIORITY_HIGH)
            ->subject("Quotation for your car booking - #$resrv_id")
            ->html("
            Good day $customer, <br/><br/>

            Thank you for your interest in our solutions at Senauto Rent. <br/><br/>

            Kindly find attached a comprehensive price list for our car rental experience. <br/><br/>

            Regards.
            ")
        ;
        $mailer->send($email);
    }
}