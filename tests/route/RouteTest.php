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
    //#region Tests
    public function testCitiesCantBeSame()
    {
        $this->expectException(InvalidArgumentException::class);
        $firstCity  = new City("Hello City");
        $secondCity = new City("Hello City");

        new Route($firstCity, $secondCity,
            Color::white(), Length::one());
    }

    /**
     * @dataProvider routeColorProvider
     */
    public function testRouteHasColor($expected, $actual)
    {
        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider routeLengthProvider
     */
    public function testRouteHasLength($expected, $actual)
    {
        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider routeClaimableProvider
     */
    public function testRouteIsClaimable($expected, $actual)
    {
        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider routeScoreProvider
     */
    public function testCalculateScore($expected, $actual)
    {
        $this->assertEquals($expected, $actual);
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

        return $data;
    }

    public function routeLengthProvider()
    {
        $data = [];
        foreach ($this->routeLengthScoreData() as $rlsData) {
            $key    = $rlsData['lengthName'];
            $route  = $rlsData['route'];

            $expected   = $rlsData['length'];
            $actual     = $route->length()->asInteger();

            $data[$key] = [$expected, $actual];
        }

        return $data;
    }

    public function routeClaimableProvider()
    {
        $firstCity  = new City("Hello City");
        $secondCity = new City("Hello Metropolis");

        $routeCards = [
            'Claimable - same-colored cards' => [
                'route' => new Route($firstCity, $secondCity,
                    Color::white(), Length::two()),
                'cards' => [ Card::white(), Card::white() ],
                'claimable' => true
            ],
            'Claimable - wildcards cards' => [
                'route' => new Route($firstCity, $secondCity,
                    Color::white(), Length::two()),
                'cards' => [ Card::locomotive(), Card::locomotive() ],
                'claimable' => true
            ],
            'Claimable - one wildcard, one same-colored' => [
                'route' => new Route($firstCity, $secondCity,
                    Color::white(), Length::two()),
                'cards' => [ Card::locomotive(), Card::white() ],
                'claimable' => true
            ],
            'Not Claimable - different-colored cards' => [
                'route' => new Route($firstCity, $secondCity,
                    Color::white(), Length::two()),
                'cards' => [ Card::white(), Card::red() ],
                'claimable' => false
            ],
            'Not Claimable - insufficient cards' => [
                'route' => new Route($firstCity, $secondCity,
                    Color::white(), Length::two()),
                'cards' => [ Card::white() ],
                'claimable' => false
            ]
        ];
        $checker = new RouteClaimChecker();

        $data = [];
        foreach ($routeCards as $key=>$val) {
            $route = $val['route'];
            $cards = new CardCollection();
            foreach ($val['cards'] as $card) {
                $cards->add($card);
            }

            $data[$key] = [
                $checker->canClaimRoute($route, $cards),
                $val['claimable']
            ];
        }

        return $data;
    }

    public function routeScoreProvider()
    {
        $data = [];
        $calculator = new ScoreCalculator();
        foreach ($this->routeLengthScoreData() as $rlsData) {
            $key    = "Length: " . $rlsData['length'] . " | " .
                "Score: " . $rlsData['score'];
            $route  = $rlsData['route'];

            $expected   = $rlsData['score'];
            $actual     = $calculator->scoreRoute($route);

            $data[$key] = [$expected, $actual];
        }

        return $data;
    }

    private function routeLengthScoreData()
    {
        $firstCity  = new City("Hello City");
        $secondCity = new City("Hello Metropolis");

        return [
            [
                'lengthName'    => 'one',
                'route'         => new Route($firstCity, $secondCity,
                    Color::white(), Length::one()),
                'length'        => 1,
                'score'         => 1
            ], [
                'lengthName'    => 'two',
                'route'         => new Route($firstCity, $secondCity,
                    Color::white(), Length::two()),
                'length'        => 2,
                'score'         => 2
            ], [
                'lengthName'    => 'three',
                'route'         => new Route($firstCity, $secondCity,
                    Color::white(), Length::three()),
                'length'        => 3,
                'score'         => 4
            ], [
                'lengthName'    => 'four',
                'route'         => new Route($firstCity, $secondCity,
                    Color::white(), Length::four()),
                'length'        => 4,
                'score'         => 7
            ], [
                'lengthName'    => 'five',
                'route'         => new Route($firstCity, $secondCity,
                    Color::white(), Length::five()),
                'length'        => 5,
                'score'         => 10
            ], [
                'lengthName'    => 'six',
                'route'         => new Route($firstCity, $secondCity,
                    Color::white(), Length::six()),
                'length'        => 6,
                'score'         => 15
            ]
        ];
    }
    //#endregion

} //end RouteTest