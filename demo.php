<?php

require_once "vendor/autoload.php";

use RRaven\Stones\Game;
use RRaven\Stones\Player;
use RRaven\Stones\Commentator;
use RRaven\Stones\Microphone;

(new Commentator())
    ->setLogger(new Microphone())
    ->setGame(
        (new Game())
            ->setStones(isset($argv[1]) ? intval($argv[1]) : 10)
            ->setFirstPlayer(new Player())
            ->setSecondPlayer(new Player())
    )
    ->commentate();
