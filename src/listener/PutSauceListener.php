<?php

namespace App\listener;

use App\event\PizzaOrderedEvent;
use App\model\PizzaStatus;
use Symfony\Component\Console\Output\OutputInterface;

class PutSauceListener
{
    public function __construct(private readonly OutputInterface $output)
    {
    }

    public function putSauce(PizzaOrderedEvent $event) : PizzaOrderedEvent
    {
        $this->output->writeln("Pizza status before putting sauce : " . $event->getPizza()->getStatus()->value);
        $this->output->writeln("Putting the Sauce ... \u{1F345}");
        sleep(2);
        $event->getPizza()->setStatus(PizzaStatus::SAUCE);

        return $event;
    }
}