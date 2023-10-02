<?php

namespace App\event;

use App\model\Pizza;
use Symfony\Contracts\EventDispatcher\Event;

class PizzaOrderedEvent extends Event
{

    public function __construct( private  Pizza $pizza){}

    public function getPizza(): Pizza
    {
        return $this->pizza;
    }

}