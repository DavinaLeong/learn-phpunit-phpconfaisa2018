<?php declare(strict_types=1);
namespace TicketToRide;

use PHPUnit\Framework\TestCase;


final class RouteColorTest extends TestCase
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
    
    public function testCanBePurple()
    {
        $firstCity = new City($this::FIRST_CITY_NAME);
        $secondCity = new City($this::SECOND_CITY_NAME);

        $route = new Route(
            $firstCity,
            $secondCity,
            Color::purple(),
            Length::one()
        );

        $this->assertEquals($route->color(), Color::purple());
    }

    public function testCanBeWhite()
    {
        $firstCity = new City($this::FIRST_CITY_NAME);
        $secondCity = new City($this::SECOND_CITY_NAME);

        $route = new Route(
            $firstCity,
            $secondCity,
            Color::white(),
            Length::one()
        );

        $this->assertEquals($route->color(), Color::white());
    }

    public function testCanBeBlue()
    {
        $firstCity = new City($this::FIRST_CITY_NAME);
        $secondCity = new City($this::SECOND_CITY_NAME);

        $route = new Route(
            $firstCity,
            $secondCity,
            Color::blue(),
            Length::one()
        );

        $this->assertEquals($route->color(), Color::blue());
    }

    public function testCanBeYellow()
    {
        $firstCity = new City($this::FIRST_CITY_NAME);
        $secondCity = new City($this::SECOND_CITY_NAME);

        $route = new Route(
            $firstCity,
            $secondCity,
            Color::yellow(),
            Length::one()
        );

        $this->assertEquals($route->color(), Color::yellow());
    }

    public function testCanBeOrange()
    {
        $firstCity = new City($this::FIRST_CITY_NAME);
        $secondCity = new City($this::SECOND_CITY_NAME);

        $route = new Route(
            $firstCity,
            $secondCity,
            Color::orange(),
            Length::one()
        );

        $this->assertEquals($route->color(), Color::orange());
    }

    public function testCanBeBlack()
    {
        $firstCity = new City($this::FIRST_CITY_NAME);
        $secondCity = new City($this::SECOND_CITY_NAME);

        $route = new Route(
            $firstCity,
            $secondCity,
            Color::black(),
            Length::one()
        );

        $this->assertEquals($route->color(), Color::black());
    }

    public function testCanBeRed()
    {
        $firstCity = new City($this::FIRST_CITY_NAME);
        $secondCity = new City($this::SECOND_CITY_NAME);

        $route = new Route(
            $firstCity,
            $secondCity,
            Color::red(),
            Length::one()
        );

        $this->assertEquals($route->color(), Color::red());
    }

    public function testCanBeGreen()
    {
        $firstCity = new City($this::FIRST_CITY_NAME);
        $secondCity = new City($this::SECOND_CITY_NAME);

        $route = new Route(
            $firstCity,
            $secondCity,
            Color::green(),
            Length::one()
        );

        $this->assertEquals($route->color(), Color::green());
    }

    public function testCanBeGray()
    {
        $firstCity = new City($this::FIRST_CITY_NAME);
        $secondCity = new City($this::SECOND_CITY_NAME);

        $route = new Route(
            $firstCity,
            $secondCity,
            Color::wildcard(),
            Length::one()
        );

        $this->assertEquals($route->color(), Color::wildcard());
    }

} //end RouteColorTest