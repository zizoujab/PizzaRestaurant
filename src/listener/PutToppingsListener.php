<?php

namespace App\listener;

use App\event\PizzaOrderedEvent;
use App\model\PizzaStatus;
use Symfony\Component\Console\Output\OutputInterface;

class PutToppingsListener
{
    public function __construct(private readonly OutputInterface $output)
    {
    }

    public function putToppings(PizzaOrderedEvent $event) : PizzaOrderedEvent
    {
        $this->output->writeln("Pizza status before putting toppings : " . $event->getPizza()->getStatus()->value);
        $this->output->writeln("Putting the toppings ... \u{1F9C5} \u{1F344} \u{1F336}");
        sleep(2);
        $event->getPizza()->setStatus(PizzaStatus::TOPPINGS);

        return $event;
    }
}