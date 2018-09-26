<?php declare(strict_types=1);
namespace TicketToRide;

use PHPUnit\Framework\TestCase;


final class RouteCardTest extends TestCase
{
    const FIRST_CITY_NAME    = "HelloCity";
    const SECOND_CITY_NAME   = "HelloMetropolis";

    public function testCorrectColourLength()
    {
        $firstCity = new City($this::FIRST_CITY_NAME);
        $secondCity = new City($this::SECOND_CITY_NAME);

        $routePurpleTwo = new Route(
            $firstCity,
            $secondCity,
            Color::purple(),
            Length::two()
        );

        $card = Card::purple();
        $cards = new CardCollection();
        $cards->add($card);
        $cards->add($card);

        $rcc = new RouteClaimChecker($routePurpleTwo, $cards);

        $this->assertTrue($rcc->canClaimRoute($routePurpleTwo, $cards));
    }

    public function testCorrectColourIncorrentLength()
    {
        $firstCity = new City($this::FIRST_CITY_NAME);
        $secondCity = new City($this::SECOND_CITY_NAME);

        $routePurpleTwo = new Route(
            $firstCity,
            $secondCity,
            Color::purple(),
            Length::three()
        );

        $card = Card::purple();
        $cards = new CardCollection();
        $cards->add($card);
        $cards->add($card);

        $rcc = new RouteClaimChecker($routePurpleTwo, $cards);

        $this->assertFalse($rcc->canClaimRoute($routePurpleTwo, $cards));
    }

} //end RouteTest