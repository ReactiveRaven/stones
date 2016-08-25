<?php


namespace RRaven\Stones;


class MicrophoneTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Microphone
     */
    private $microphone;

    public function setUp()
    {
        $this->microphone = new Microphone();
    }

    public function testLog()
    {
        $this->expectOutputString("info: First player took 3 stones\n");

        $this->microphone->log("info", "First player took 3 stones");
    }

    public function testAlert()
    {
        $message = "message";

        $mock = $this->getMock(Microphone::class, [ "log" ]);
        $mock->expects($this->once())
            ->method("log")
            ->with("alert", $message);

        $mock->alert($message);
    }

    public function testCritical()
    {
        $message = "message";

        $mock = $this->getMock(Microphone::class, [ "log" ]);
        $mock->expects($this->once())
            ->method("log")
            ->with("critical", $message);

        $mock->critical($message);
    }

    public function testDebug()
    {
        $message = "message";

        $mock = $this->getMock(Microphone::class, [ "log" ]);
        $mock->expects($this->once())
            ->method("log")
            ->with("debug", $message);

        $mock->debug($message);
    }

    public function testEmergency()
    {
        $message = "message";

        $mock = $this->getMock(Microphone::class, [ "log" ]);
        $mock->expects($this->once())
            ->method("log")
            ->with("emergency", $message);

        $mock->emergency($message);
    }


    public function testError()
    {
        $message = "message";

        $mock = $this->getMock(Microphone::class, [ "log" ]);
        $mock->expects($this->once())
            ->method("log")
            ->with("error", $message);

        $mock->error($message);
    }


    public function testInfo()
    {
        $message = "message";

        $mock = $this->getMock(Microphone::class, [ "log" ]);
        $mock->expects($this->once())
            ->method("log")
            ->with("info", $message);

        $mock->info($message);
    }


    public function testNotice()
    {
        $message = "message";

        $mock = $this->getMock(Microphone::class, [ "log" ]);
        $mock->expects($this->once())
            ->method("log")
            ->with("notice", $message);

        $mock->notice($message);
    }


    public function testWarning()
    {
        $message = "message";

        $mock = $this->getMock(Microphone::class, [ "log" ]);
        $mock->expects($this->once())
            ->method("log")
            ->with("warning", $message);

        $mock->warning($message);
    }
}
