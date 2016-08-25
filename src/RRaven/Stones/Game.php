<?php

namespace RRaven\Stones;


use RRaven\Stones\Exception\PlayerCheatingException;

class Game
{
    /**
     * @var int
     */
    private $stones;

    /**
     * @var Player
     */
    private $firstPlayer;

    /**
     * @var Player
     */
    private $secondPlayer;

    public function __construct()
    {
        $this->firstPlayer = new Player();
        $this->secondPlayer = new Player();
    }

    public function setStones($newStones)
    {
        $this->stones = $newStones;
        return $this;
    }

    public function getStones()
    {
        return $this->stones;
    }

    public function getFirstPlayer()
    {
        return $this->firstPlayer;
    }

    public function setFirstPlayer(Player $newPlayer)
    {
        $this->firstPlayer = $newPlayer;
        return $this;
    }

    public function getSecondPlayer()
    {
        return $this->secondPlayer;
    }

    public function setSecondPlayer(Player $newPlayer)
    {
        $this->secondPlayer = $newPlayer;
        return $this;
    }

    /**
     * Advances the game by one turn, allowing both players to make their moves.
     *
     * @return int[] array of moves
     */
    public function tick()
    {
        $firstMove = $this->checkValidMove($this->firstPlayer->move($this->stones));
        $this->stones -= $firstMove;

        $secondMove = 0;
        if ($this->stones > 0) {
            $secondMove = $this->checkValidMove($this->secondPlayer->move($this->stones));
            $this->stones -= $secondMove;
        }

        return [ $firstMove, $secondMove ];
    }

    /**
     * @param $amount int
     * @return int
     * @throws PlayerCheatingException
     */
    private function checkValidMove($amount)
    {
        if ($amount > 3) {
            throw new PlayerCheatingException("Must not take more than three stones");
        }

        if ($amount > $this->stones) {
            throw new PlayerCheatingException("Tried to take more stones than are left");
        }

        return $amount;
    }

    public function isFinished()
    {
        return $this->stones < 1;
    }
}
