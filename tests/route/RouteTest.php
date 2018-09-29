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

        $this->cardsPurple        = new CardCollection();
        $this->cardsPurple->add(Card::purple());
        $this->cardsPurple->add(Card::purple());
    }

    public function testCitiesCantBeSame()
    {
        $this->expectException(InvalidArgumentException::class);
        new Route($this->city, $this->citySameName, Color::red(), Length::one());
    }

    public function testRouteHasColor()
    {
        $expected   = Color::purple();
        $actual     = $this->routePurple->color();
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

    public function testWildcardClaim()
    {
        $this->markTestIncomplete();
    }

    public function testCalculateScore()
    {
        $this->markTestIncomplete();
    }

} //end RouteTest