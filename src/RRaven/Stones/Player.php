<?php


namespace RRaven\Stones;


class Player
{
    private $name;

    public function __construct($name = "hello")
    {
        $this->name = $name;
    }

    public function move($numStones)
    {
        return max($numStones % 4, 1);
    }
}
