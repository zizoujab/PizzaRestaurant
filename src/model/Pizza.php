<?php

namespace App\model;

class Pizza
{
    public function __construct(private PizzaStatus $status, private readonly PizzaSize $size){}

    public function getStatus(): PizzaStatus
    {
        return $this->status;
    }

    public function setStatus(PizzaStatus $status): void
    {
        $this->status = $status;
    }

    public function getSize(): PizzaSize
    {
        return $this->size;
    }




}