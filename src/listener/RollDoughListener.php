<?php

namespace App\listener;

use App\event\PizzaOrderedEvent;
use App\model\PizzaStatus;
use Symfony\Component\Console\Output\OutputInterface;

class RollDoughListener
{
    public function __construct(private readonly OutputInterface $output) {}

    public function rollDough(PizzaOrderedEvent $event) : PizzaOrderedEvent
    {
        $this->output->writeln("Pizza status before rolling dough : " . $event->getPizza()->getStatus()->value);
        $this->output->writeln("Rolling the dough .... ");
        sleep(3);
        $event->getPizza()->setStatus(PizzaStatus::DOUGH);

        return $event;
    }

}