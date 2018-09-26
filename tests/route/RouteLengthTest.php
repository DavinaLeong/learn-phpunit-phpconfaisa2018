<?php declare(strict_types=1);
namespace TicketToRide;

use PHPUnit\Framework\TestCase;

final class RouteLengthTest extends TestCase
{
    const FIRST_CITY_NAME    = "HelloCity";
    const SECOND_CITY_NAME   = "HelloMetropolis";

    public function testCanBeOne()
    {
        $firstCity = new City($this::FIRST_CITY_NAME);
        $secondCity = new City($this::SECOND_CITY_NAME);

        $route = new Route(
            $firstCity,
            $secondCity,
            Color::purple(),
            Length::one()
        );

        $this->assertEquals($route->length(), Length::one());
    }

    public function Two()
    {
        $firstCity = new City($this::FIRST_CITY_NAME);
        $secondCity = new City($this::SECOND_CITY_NAME);

        $route = new Route(
            $firstCity,
            $secondCity,
            Color::purple(),
            Length::two()
        );

        $this->assertEquals($route->length(), Length::two());
    }

    public function testCanBeThree()
    {
        $firstCity = new City($this::FIRST_CITY_NAME);
        $secondCity = new City($this::SECOND_CITY_NAME);

        $route = new Route(
            $firstCity,
            $secondCity,
            Color::purple(),
            Length::three()
        );

        $this->assertEquals($route->length(), Length::three());
    }

    public function testCanBeFour()
    {
        $firstCity = new City($this::FIRST_CITY_NAME);
        $secondCity = new City($this::SECOND_CITY_NAME);

        $route = new Route(
            $firstCity,
            $secondCity,
            Color::purple(),
            Length::four()
        );

        $this->assertEquals($route->length(), Length::four());
    }

    public function testCanBeFive()
    {
        $firstCity = new City($this::FIRST_CITY_NAME);
        $secondCity = new City($this::SECOND_CITY_NAME);

        $route = new Route(
            $firstCity,
            $secondCity,
            Color::purple(),
            Length::five()
        );

        $this->assertEquals($route->length(), Length::five());
    }

    public function testCanBeSix()
    {
        $firstCity = new City($this::FIRST_CITY_NAME);
        $secondCity = new City($this::SECOND_CITY_NAME);

        $route = new Route(
            $firstCity,
            $secondCity,
            Color::purple(),
            Length::six()
        );

        $this->assertEquals($route->length(), Length::six());
    }

} //end RouteLengthTest