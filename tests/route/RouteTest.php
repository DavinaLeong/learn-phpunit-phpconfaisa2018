<?php declare(strict_types=1);
namespace TicketToRide;

use PHPUnit\Framework\TestCase;

/**
 * @covers \TicketToRide\Route
 * 
 * @uses \TicketToRide\City
 * @uses \TicketToRide\Color
 * @uses \TicketToRide\Length
 */
final class RouteTest extends TestCase
{
    // === Tests ==============================================================
    public function testCitiesCantBeSame(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $firstCity  = new City("Hello City");
        $secondCity = new City("Hello City");

        new Route($firstCity, $secondCity, Color::white(),
            Length::one());
    }

    /**
     * @dataProvider routeColorProvider
     */
    public function testRouteCanHaveColor(Color $color, Route $route): void
    {
        $expected   = $color;
        $actual     = $route->color();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider routeLengthProvider
     */
    public function testRouteCanHaveLength(Length $length, Route $route): void
    {
        $expected   = $length->asInteger();
        $actual     = $route->length()->asInteger();
        $this->assertEquals($expected, $actual);
    }
    
    
    // === Data Providers =====================================================
    public function routeColorProvider(): array
    {
        $city         = new City("Hello City");
        $cityDiffName = new City("Hello Metropolis");

        $data = [
            'purple' => [
                Color::purple(),
                new Route($city, $cityDiffName,
                    Color::purple(), Length::one())
            ],
            'white' => [
                Color::white(),
                new Route($city, $cityDiffName,
                    Color::white(), Length::one())
            ],
            'blue' => [
                Color::blue(),
                new Route($city, $cityDiffName,
                    Color::blue(), Length::one())
            ],
            'yellow' => [
                Color::yellow(),
                new Route($city, $cityDiffName,
                    Color::yellow(), Length::one())
            ],
            'orange' => [
                Color::orange(),
                new Route($city, $cityDiffName,
                    Color::orange(), Length::one())
            ],
            'black' => [
                Color::black(),
                new Route($city, $cityDiffName,
                    Color::black(), Length::one())
            ],
            'red' => [
                Color::red(),
                new Route($city, $cityDiffName,
                    Color::red(), Length::one())
            ],
            'green' => [
                Color::green(),
                new Route($city, $cityDiffName,
                    Color::green(), Length::one())
            ],
            'wildcard' => [
                Color::wildcard(),
                new Route($city, $cityDiffName,
                    Color::wildcard(), Length::one())
            ]
        ];

        return $data;
    }

    public function routeLengthProvider(): array
    {
        $firstCity  = new City("Hello City");
        $secondCity = new City("Hello Metropolis");

        return [
            'one'   => [
                Length::one(),
                new Route($firstCity, $secondCity, Color::white(),
                    Length::one())
            ],
            'two'   => [
                Length::two(),
                new Route($firstCity, $secondCity, Color::white(),
                    Length::two())
            ],
            'three' => [
                Length::three(),
                new Route($firstCity, $secondCity, Color::white(),
                    Length::three())
            ],
            'four'  => [
                Length::four(),
                new Route($firstCity, $secondCity, Color::white(),
                    Length::four())
            ],
            'five'  => [
                Length::five(),
                new Route($firstCity, $secondCity, Color::white(),
                    Length::five())
            ],
            'six'   => [
                Length::six(),
                new Route($firstCity, $secondCity, Color::white(),
                    Length::six())
            ]
        ];
    }

} //end RouteTest