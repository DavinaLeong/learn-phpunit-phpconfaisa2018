<?php declare(strict_types=1);
namespace TicketToRide;

use PHPUnit\Framework\TestCase;

final class CityTest extends TestCase
{
    private $city;

    public function setUp()
    {
        $this->city = new City("Hello City");
    }

    public function testNameCannotBeEmpty()
    {
        $this->expectException(InvalidArgumentException::class);
        new City('');
    }

    public function testValidCity()
    {
        $expected = "Hello City";
        $actual = $this->city->name();
        $this->assertEquals($expected, $actual);
    }

} //end CityTest