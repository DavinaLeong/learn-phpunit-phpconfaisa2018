<?php declare(strict_types=1);
namespace TicketToRide;

use PHPUnit\Framework\TestCase;

final class CityTest extends TestCase
{
    public function testNameIsSingapore()
    {
        $city = new City("Singapore");
        $this->assertEquals($city->name(), "Singapore");
    }

    public function testEmptyNameException()
    {
        $this->expectException(InvalidArgumentException::class);
        $city = new City(" ");
    }

} // end CityTest