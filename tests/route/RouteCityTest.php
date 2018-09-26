<?php declare(strict_types=1);
namespace TicketToRide;

use PHPUnit\Framework\TestCase;


final class RouteCityTest extends TestCase
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

        $this->assertEquals($route->firstCity()->name(), $this::FIRST_CITY_NAME);
    }

    public function testCitiesCannotBeSame()
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