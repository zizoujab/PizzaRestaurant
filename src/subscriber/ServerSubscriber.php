<?php

namespace App\subscriber;

use App\event\PizzaOrderedEvent;
use App\event\PizzaReadyEvent;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ServerSubscriber implements EventSubscriberInterface
{

    public function __construct(private readonly OutputInterface $output)
    {
    }

    public static function getSubscribedEvents()
    {
        return [
            PizzaOrderedEvent::class => 'onPizzaOrdered',
            PizzaReadyEvent::class => 'onPizzaReady'
        ];
    }

    public function onPizzaOrdered(PizzaOrderedEvent $event)
    {
        $this->serveBeverages();
    }

    public function onPizzaReady(PizzaReadyEvent $event)
    {
        $this->servePizza($event);
    }

    private function serveBeverages()
    {
        $this->output->writeln("Serving the beverages \u{1F964} .... ");

    }

    private function servePizza(PizzaReadyEvent $event)
    {
        $this->output->writeln("Serving pizza \u{1F355} of size " . $event->getPizza()->getSize()->value);
    }
}