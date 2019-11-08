<?php
namespace App\Event;

use Symfony\Component\EventDispatcher\Event;
use App\Entity\Reservation;

class ReservationConfirmedEvent extends Event{
    const NAME = 'reservation.confirmed';

    protected $reservation;

    public function __construct(Reservation $reservation){
       $this->reservation = $reservation;
    }

    public function getReservation(){
        return $this->reservation;
    }
}