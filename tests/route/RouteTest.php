<?php declare(strict_types=1);
namespace TicketToRide;

use PHPUnit\Framework\TestCase;


/**
 * @covers \TicketToRide\Route
 *
 * @uses \TicketToRide\Color
 */
final class RouteTest extends TestCase
{
    const FIRST_CITY_NAME    = "HelloCity";
    const SECOND_CITY_NAME   = "HelloMetropolis";

    public function testValidRoute()
    {
        $firstCity = new City($this::FIRST_CITY_NAME);
        $secondCity = new City($this::SECOND_CITY_NAME);

        $route = new Route(
            $firstCity,
            $secondCity,
            Color::purple(),
            Length::one()
        );

        $this->assertNotNull($route);
    }

    public function testCityCannotBeSame()
    {
        $this->expectException(InvalidArgumentException::class);

        $firstCity = new City($this::FIRST_CITY_NAME);
        $secondCity = new City($this::FIRST_CITY_NAME);

        $route = new Route(
            $firstCity,
            $secondCity,
            Color::purple(),
            Length::one()
        );
    }

} //end RouteTest