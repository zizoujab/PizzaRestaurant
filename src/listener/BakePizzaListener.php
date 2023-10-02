<?php

namespace App\listener;

use App\event\PizzaOrderedEvent;
use App\model\PizzaStatus;
use Symfony\Component\Console\Output\OutputInterface;

class BakePizzaListener
{
    public function __construct(private readonly OutputInterface $output)
    {
    }

    public function bakePizza(PizzaOrderedEvent $event) : PizzaOrderedEvent
    {
        $this->output->writeln("Pizza status before baking: " . $event->getPizza()->getStatus()->value);
        $this->output->writeln("Baking the pizza ... \u{1F525}");
        sleep(2);
        $event->getPizza()->setStatus(PizzaStatus::BAKING);

        return $event;
    }
}