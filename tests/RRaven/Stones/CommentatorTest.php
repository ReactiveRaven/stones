<?php


namespace RRaven\Stones;


use Psr\Log\LoggerInterface;

class CommentatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Commentator
     */
    private $commentator;

    public function setUp()
    {
        $this->commentator = new Commentator();
    }

    public function testSetLogger()
    {
        $mock = $this->getMock(Microphone::class);

        $this->commentator->setLogger($mock);

        $this->assertEquals($mock, $this->commentator->getLogger());
    }

    public function testSetGame()
    {
        $mock = $this->getMock(Game::class);

        $this->commentator->setGame($mock);

        $this->assertEquals($mock, $this->commentator->getGame());
    }

    public function testCommentate()
    {
        $game = $this->getMock(Game::class, [ "getStones", "tick", "isFinished" ]);

        $game->expects($this->at(0))
            ->method("getStones")
            ->willReturn(4);

        $game->expects($this->at(1))
            ->method("isFinished")->willReturn(false);

        $game->expects($this->at(2))
            ->method("tick")
            ->willReturn([ 2, 2 ]);

        $game->expects($this->at(3))
            ->method("getStones")
            ->willReturn(0);

        $game->expects($this->at(4))
            ->method("isFinished")->willReturn(true);

        $this->commentator->setGame($game);

        $mockLogger = $this->getMock(Microphone::class, [ "log" ]);

        $mockLogger->expects($this->at(0))
            ->method("log")
            ->with("debug", "Game starting with 4 stones");

        $mockLogger->expects($this->at(1))
            ->method("log")
            ->with("debug", "First player takes 2 stones, Second player takes 2 stones, 0 stones left");

        $mockLogger->expects($this->at(2))
            ->method("log")
            ->with("info", "Second player wins!");

        $this->commentator->setLogger($mockLogger);

        $this->commentator->commentate();
    }
}

