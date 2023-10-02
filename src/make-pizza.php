<?php

use App\event\PizzaOrderedEvent;
use App\event\PizzaReadyEvent;
use App\listener\BakePizzaListener;
use App\listener\PutSauceListener;
use App\listener\PutToppingsListener;
use App\listener\RollDoughListener;
use App\model\Pizza;
use App\model\PizzaSize;
use App\model\PizzaStatus;
use App\subscriber\ServerSubscriber;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\SingleCommandApplication;
use Symfony\Component\EventDispatcher\EventDispatcher;

require_once __DIR__ . "/../vendor/autoload.php";


(new SingleCommandApplication())
    ->setCode(function (InputInterface $input, OutputInterface $output): int {

        $pizza = new Pizza(PizzaStatus::ORDERED, PizzaSize::EXTRA_LARGE);
        $dispatcher = new EventDispatcher();

        $serverSubscriber = new ServerSubscriber($output);
        $rollingDoughListener = new RollDoughListener($output);
        $putSauceListener = new PutSauceListener($output);
        $putToppingsListener = new PutToppingsListener($output);
        $bakePizzaListener = new BakePizzaListener($output);

        $dispatcher->addSubscriber($serverSubscriber);
        $dispatcher->addListener(PizzaOrderedEvent::class, [$rollingDoughListener, 'rollDough']);
        $dispatcher->addListener(PizzaOrderedEvent::class, [$putSauceListener, 'putSauce']);
        $dispatcher->addListener(PizzaOrderedEvent::class, [$putToppingsListener, 'putToppings']);
        $dispatcher->addListener(PizzaOrderedEvent::class, [$bakePizzaListener, 'bakePizza']);

        $pizzaOrderedEvent = new PizzaOrderedEvent($pizza);
        $dispatcher->dispatch($pizzaOrderedEvent);
        $pizzaReadyEvent = new PizzaReadyEvent($pizzaOrderedEvent->getPizza());
        $dispatcher->dispatch($pizzaReadyEvent);

        return Command::SUCCESS;
    })
    ->run();
