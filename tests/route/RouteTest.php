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
    public function testCannotConnectTwoSameCities(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Route(
            new City("Same City"),
            new City("Same City"),
            Color::white(),
            Length::one()
        );
    }

    public function testCanConnectTwoDifferentCities(): void
    {
        $route = new Route(
            new City("Same City"),
            new City("Different City"),
            Color::white(),
            Length::one()
        );
        $expected   = true;
        $actual     = ($route->firstCity()->name() !== $route->secondCity()->name());
        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider routeColorProvider
     */
    public function testRouteCanHaveColor(Color $color, string $colorValue): void
    {
        $route = new Route(
            new City("Same City"),
            new City("Different City"),
            $color,
            Length::one()
        );
        $expected   = $colorValue;
        $actual     = $route->color()->asString();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider routeLengthProvider
     */
    public function testRouteCanHaveLength(Length $length, int $lengthValue): void
    {
        $route = new Route(
            new City("Same City"),
            new City("Different City"),
            Color::white(),
            $length
        );

        $expected   = $lengthValue;
        $actual     = $route->length()->asInteger();
        $this->assertEquals($expected, $actual);
    }
    
    
    // === Data Providers =====================================================
    public function routeColorProvider(): array
    {
        $data = [
            'purple'    => [Color::purple(), 'purple'],
            'white'     => [Color::white(), 'white'],
            'blue'      => [Color::blue(), 'blue'],
            'yellow'    => [Color::yellow(), 'yellow'],
            'orange'    => [Color::orange(), 'orange'],
            'black'     => [Color::black(), 'black'],
            'red'       => [Color::red(), 'red'],
            'green'     => [Color::green(), 'green'],
            'wildcard'  => [Color::wildcard(), 'wildcard']
        ];

        return $data;
    }

    public function routeLengthProvider(): array
    {
        return [
            'one'   => [Length::one(), 1],
            'two'   => [Length::two(), 2],
            'three' => [Length::three(), 3],
            'four'  => [Length::four(), 4],
            'five'  => [Length::five(), 5],
            'six'   => [Length::six(), 6]
        ];
    }

} //end RouteTest