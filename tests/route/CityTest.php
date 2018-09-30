<?php declare(strict_types=1);
namespace TicketToRide;

use PHPUnit\Framework\TestCase;

/**
 * @covers \TicketToRide\City
 */
final class CityTest extends TestCase
{
    public function testNameCannotBeEmpty()
    {
        $this->expectException(InvalidArgumentException::class);
        new City('');
    }

} //end CityTest