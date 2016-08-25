<?php


namespace RRaven\Stones;


use RRaven\Stones\Exception\PlayerCheatingException;

class GameTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Game
     */
    private $game;

    public function setUp()
    {
        $this->game = new Game();
    }

    public function testSetStones()
    {
        for ($i = 0; $i < 100; $i++) {
            $this->game->setStones($i);
            $this->assertEquals($i, $this->game->getStones(), "Should set stones correctly");
        }
    }

    public function testSetFirstPlayer()
    {
        $newPlayer = new Player();
        $this->assertNotSame($newPlayer, $this->game->getFirstPlayer());
        $this->game->setFirstPlayer($newPlayer);
        $this->assertSame($newPlayer, $this->game->getFirstPlayer());
        $this->assertNotSame($newPlayer, $this->game->getSecondPlayer());
    }

    public function testSetSecondPlayer()
    {
        $newPlayer = new Player();
        $this->assertNotSame($newPlayer, $this->game->getSecondPlayer());
        $this->game->setSecondPlayer($newPlayer);
        $this->assertSame($newPlayer, $this->game->getSecondPlayer());
        $this->assertNotSame($newPlayer, $this->game->getFirstPlayer());
    }

    public function testTick()
    {
        $playerMock = $this->getMock(Player::class, [ "move" ]);

        $playerMock->expects($this->atLeastOnce())
            ->method("move")
            ->will($this->returnValue(2));

        $this->game->setFirstPlayer($playerMock)
            ->setSecondPlayer($playerMock);

        $this->game->setStones(10);

        $this->game->tick();

        $this->assertEquals(6, $this->game->getStones(), "Should update stones left in game");
    }

    public function testHandlesCheaters()
    {
        $this->setExpectedException(PlayerCheatingException::class);

        $cheater = $this->getMock(Player::class, [ "move" ]);
        $cheater->method("move")->will($this->returnValue(100));
        $this->game->setFirstPlayer($cheater);
        $this->game->setSecondPlayer($cheater);
        $this->game->setStones(1000);

        $this->game->tick();
    }

    public function testHandlesMissingStones()
    {
        $this->setExpectedException(PlayerCheatingException::class);

        $absentMindedPlayer = $this->getMock(Player::class, [ "move" ]);
        $absentMindedPlayer->method("move")->will($this->returnValue(3));
        $this->game->setFirstPlayer($absentMindedPlayer);
        $this->game->setSecondPlayer($absentMindedPlayer);
        $this->game->setStones(2);

        $this->game->tick();
    }

    public function testGameFinished()
    {
        $this->game->setStones(10);

        $this->assertEquals(
            false,
            $this->game->isFinished(),
            "As long as there are stones left, the game can continue"
        );

        $this->game->setStones(0);

        $this->assertEquals(
            true,
            $this->game->isFinished(),
            "No stones left? No game"
        );

        $this->game->setStones(-10);

        $this->assertEquals(
            true,
            $this->game->isFinished(),
            "Negative stones? Go find some to start the game!"
        );
    }
}
