<?php


namespace RRaven\Stones;

use Psr\Log\LoggerInterface;

class Commentator
{
    /**
     * @var Game
     */
    private $game;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @return Game
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * @param Game $game
     * @return Commentator
     */
    public function setGame($game)
    {
        $this->game = $game;
        return $this;
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * @param LoggerInterface $logger
     * @return Commentator
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
        return $this;
    }

    private function getStoneString($number)
    {
        $result = $number . " stone";
        if ($number !== 1) {
            $result .= "s";
        }

        return $result;
    }

    public function commentate()
    {
        $this->logger->debug("Game starting with " . $this->getStoneString($this->game->getStones()));

        $moves;

        while (!$this->game->isFinished()) {
            $moves = $this->game->tick();
            $this->logger->debug(
                "First player takes " . $this->getStoneString($moves[0]) .
                ", Second player takes " . $this->getStoneString($moves[1]) .
                ", " . $this->getStoneString($this->game->getStones()) . " left"
            );
        }

        if ($moves[1] === 0) {
            $this->logger->info("First player wins!");
        } else {
            $this->logger->info("Second player wins!");
        }
    }
}
