<?php declare(strict_types=1);
namespace TicketToRide;

use PHPUnit\Framework\TestCase;

final class RouteTest extends TestCase
{
    private $city;
    private $citySameName;
    private $cityDiffName;

    private $route;

    public function setUp()
    {
        $this->city         = new City("Hello City");
        $this->citySameName = new City("Hello City");
        $this->cityDiffName = new City("Hello Metropolis");

        $this->route        = new Route($this->city, $this->cityDiffName, Color::purple(), Length::two());
    }

    public function testNamesCantBeSame()
    {
        $this->expectException(InvalidArgumentException::class);
        new Route($this->city, $this->citySameName, Color::red(), Length::one());
    }

    public function testHasColor()
    {
        $expected   = Color::purple();
        $actual     = $this->route->color();
        $this->assertEquals($expected, $actual);
    }

} //end RouteTest