<?php declare(strict_types=1);
namespace TicketToRide;

use PHPUnit\Framework\TestCase;

/**
 * @covers \TicketToRide\Game\RouteClaimChecker
 * 
 * @uses \TicketToRide\City
 * @uses \TicketToRide\Color
 * @uses \TicketToRide\Length
 * @uses \TicketToRide\Route
 */
final class RouteClaimCheckerTest extends TestCase
{
    // === Tests ==============================================================
    /**
     * @dataProvider routeClaimableProvider
     */
    public function testRouteCanBeClaimed(bool $canBeClaimed, Route $route,
        CardCollection $cards): void
    {
        $checker    = new RouteClaimChecker();

        $expected   = $canBeClaimed;
        $actual     = $checker->canClaimRoute($route, $cards);
        $this->assertEquals($expected, $actual);
    }
    
    
    // === Data Providers =====================================================
    public function routeClaimableProvider(): array
    {
        $firstCity  = new City("Hello City");
        $secondCity = new City("Hello Metropolis");

        /* Structure:
         * [dataset name] => [
         *      0 => Can route be claimed?
         *      1 => Route
         *      2 => Card collection
         * ]
         */
        $data = [
            'Can be Claimed - same-colored cards' => [
                true,
                new Route($firstCity, $secondCity, Color::white(),
                    Length::two()),
                [Card::white(), Card::white()]
            ],
            'Can be Claimed - wildcards cards' => [
                true,
                new Route($firstCity, $secondCity, Color::white(),
                    Length::two()),
                [Card::locomotive(), Card::locomotive()]
            ],
            'Can be Claimed - wildcard and same-colored' => [
                true,
                new Route($firstCity, $secondCity, Color::white(),
                    Length::two()),
                [Card::locomotive(), Card::white()]
            ],
            'Cannot be Claimed - different-colored cards' => [
                false,
                new Route($firstCity, $secondCity, Color::white(),
                    Length::two()),
                [Card::white(), Card::red()]
            ],
            'Cannot be Claimed - insufficient cards' => [
                false,
                new Route($firstCity, $secondCity, Color::white(),
                    Length::two()),
                [Card::white()]
            ]
        ];

        //Replace the cards array with an actual card collection
        foreach ($data as $key=>$val) {
            $cards = $val[2];
            $collection = new CardCollection();

            foreach($cards as $keyCard=>$valCard) {
                $collection->add($valCard);
            }

            $data[$key][2] = $collection;
        }

        return $data;
    }

} //end RouteClaimCheckerTest