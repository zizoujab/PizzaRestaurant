<?php

namespace App\model;

enum PizzaStatus : string
{
    case DOUGH = 'dough';
    case SAUCE = 'sauce';
    case TOPPINGS = 'toppings';
    case BAKING = 'baking';
    case READY = 'ready';
    case ORDERED = 'ordered';

}