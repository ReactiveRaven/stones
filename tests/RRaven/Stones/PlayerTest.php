<?php


namespace RRaven\Stones;


class PlayerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Player
     */
    private $player;

    public function setUp()
    {
        $this->player = new Player();
    }

    public function testMove() {
        $this->assertEquals(1, $this->player->move(1), "Should take the last stone");
        $this->assertEquals(2, $this->player->move(2), "Should take stones to closest multiple of 4");
        $this->assertEquals(3, $this->player->move(3), "Should take stones to closest multiple of 4");
        $this->assertEquals(1, $this->player->move(4), "Should take a minimum of one stone");
        $this->assertEquals(1, $this->player->move(5), "Should take stones to closest multiple of 4");
    }
}
