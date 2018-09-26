<?php declare(strict_types=1);
namespace TicketToRide;

use PHPUnit\Framework\TestCase;

/**
 * @covers \TicketToRide\Length
 */
final class LengthTest extends TestCase
{
    public function testCanBeOne()
    {
        $length = Length::one();
        $this->assertEquals(1, $length->one()->asInteger());
    }

    public function testCanBeTwo()
    {
        $length = Length::two();
        $this->assertEquals(2, $length->two()->asInteger());
    }

    public function testCanBeThree()
    {
        $length = Length::three();
        $this->assertEquals(3, $length->three()->asInteger());
    }

    public function testCanBeFour()
    {
        $length = Length::four();
        $this->assertEquals(4, $length->four()->asInteger());
    }

    public function testCanBeFive()
    {
        $length = Length::five();
        $this->assertEquals(5, $length->five()->asInteger());
    }

    public function testCanBeSix()
    {
        $length = Length::six();
        $this->assertEquals(6, $length->six()->asInteger());
    }

} //end LengthTest