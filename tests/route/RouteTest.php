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
    private $city;
    private $citySameName;
    private $cityDiffName;

    private $routePurple;
    private $routeGray;

    private $cardsPurple;

    public function setUp()
    {
        $this->city         = new City("Hello City");
        $this->citySameName = new City("Hello City");
        $this->cityDiffName = new City("Hello Metropolis");

        $this->routePurple  = new Route($this->city, $this->cityDiffName,
            Color::purple(), Length::two());
        $this->routeGray    = new Route($this->city, $this->cityDiffName,
            Color::wildcard(), Length::two());

        $this->cardsPurple  = new CardCollection();
        $this->cardsPurple->add(Card::purple());
        $this->cardsPurple->add(Card::purple());
    }

    //#region Tests
    public function testCitiesCantBeSame()
    {
        $this->expectException(InvalidArgumentException::class);
        new Route($this->city, $this->citySameName, Color::red(), Length::one());
    }

    /**
     * @dataProvider routeColorProvider
     */
    public function testRouteHasColor($expected, $actual)
    {
        $this->assertEquals($expected, $actual);
    }

    public function testRouteHasLength()
    {
        $expected   = Length::two();
        $actual     = $this->routePurple->length();
        $this->assertEquals($expected, $actual);
    }

    public function testRouteIsClaimable()
    {
        $checker    = new RouteClaimChecker();
        $expected   = $checker->canClaimRoute($this->routePurple, $this->cardsPurple);

        $this->assertTrue($expected);
    }

    public function testWildcardClaimable()
    {
        $checker    = new RouteClaimChecker();
        $expected   = $checker->canClaimRoute($this->routeGray, $this->cardsPurple);

        $this->assertTrue($expected);
    }

    public function testCalculateScore()
    {
        $this->markTestIncomplete();
    }
    //#endregion


    //#region Data Providers
    public function routeColorProvider()
    {
        $city         = new City("Hello City");
        $cityDiffName = new City("Hello Metropolis");

        $data = [
            'purple' => [
                new Route($city, $cityDiffName,
                    Color::purple(), Length::one()),
                Color::purple()
            ],
            'white' => [
                new Route($city, $cityDiffName,
                    Color::white(), Length::one()),
                Color::white()
            ],
            'blue' => [
                new Route($city, $cityDiffName,
                    Color::blue(), Length::one()),
                Color::blue()
            ],
            'yellow' => [
                new Route($city, $cityDiffName,
                    Color::yellow(), Length::one()),
                Color::yellow()
            ],
            'orange' => [
                new Route($city, $cityDiffName,
                    Color::orange(), Length::one()),
                Color::orange()
            ],
            'black' => [
                new Route($city, $cityDiffName,
                    Color::black(), Length::one()),
                Color::black()
            ],
            'red' => [
                new Route($city, $cityDiffName,
                    Color::red(), Length::one()),
                Color::red()
            ],
            'green' => [
                new Route($city, $cityDiffName,
                    Color::green(), Length::one()),
                Color::green()
            ],
            'wildcard' => [
                new Route($city, $cityDiffName,
                    Color::wildcard(), Length::one()),
                Color::wildcard()
            ]
        ];

        foreach ($data as $key=>$val) {
            $data[$key][0] = $val[0]->color();
        }
        var_dump($data);

        return $data;
    }
    //#endregion

} //end RouteTest