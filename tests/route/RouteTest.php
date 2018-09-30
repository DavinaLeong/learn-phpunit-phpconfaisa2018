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

    /**
     * @dataProvider routeScoreProvider
     */
    public function testCalculateScore($expected, $actual): void
    {
        $this->assertEquals($expected, $actual);
    }
    //#endregion


    //#region Data Providers
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
        $data = [];
        foreach ($this->routeLengthScoreData() as $rlsData) {
            $key    = $rlsData['lengthName'];
            $length = $rlsData['length'];
            $route  = $rlsData['route'];

            $data[$key] = [$length, $route];
        }

        return $data;
    }

    public function routeClaimableProvider(): array
    {
        $firstCity  = new City("Hello City");
        $secondCity = new City("Hello Metropolis");

        /* Structure:
         * dataset name = [
         *      0 => can be claimed; expected result
         *      1 => Route
         *      2 => Card collection
         * ]
         */
        $data = [
            'Claimable - same-colored cards' => [
                true,   //expected
                new Route($firstCity, $secondCity, Color::white(),
                    Length::two()),
                [Card::white(), Card::white()]
            ],
            'Claimable - wildcards cards' => [
                true,   //expected
                new Route($firstCity, $secondCity, Color::white(),
                    Length::two()),
                [Card::locomotive(), Card::locomotive()]
            ],
            'Claimable - one wildcard, one same-colored' => [
                true,   //expected
                new Route($firstCity, $secondCity, Color::white(),
                    Length::two()),
                [Card::locomotive(), Card::white()]
            ],
            'Not Claimable - different-colored cards' => [
                false,  //expected
                new Route($firstCity, $secondCity, Color::white(),
                    Length::two()),
                [Card::white(), Card::red()]
            ],
            'Not Claimable - insufficient cards' => [
                false,  //expected
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

    public function routeScoreProvider(): array
    {
        $data = [];
        $calculator = new ScoreCalculator();
        foreach ($this->routeLengthScoreData() as $rlsData) {
            $route  = $rlsData['route'];
            $length = $route->length()->asInteger();
            $score  = $rlsData['score'];
            $key    = "Length: $length | Score: $score";

            $expected   = $score;
            $actual     = $calculator->scoreRoute($route);

            $data[$key] = [$expected, $actual];
        }

        return $data;
    }

    private function routeLengthScoreData(): array
    {
        $firstCity  = new City("Hello City");
        $secondCity = new City("Hello Metropolis");

        return [
            [
                'lengthName'    => 'one',
                'route'         => new Route($firstCity, $secondCity,
                    Color::white(), Length::one()),
                'length'        => Length::one(),
                'score'         => 1
            ], [
                'lengthName'    => 'two',
                'route'         => new Route($firstCity, $secondCity,
                    Color::white(), Length::two()),
                'length'        => Length::two(),
                'score'         => 2
            ], [
                'lengthName'    => 'three',
                'route'         => new Route($firstCity, $secondCity,
                    Color::white(), Length::three()),
                'length'        => Length::three(),
                'score'         => 4
            ], [
                'lengthName'    => 'four',
                'route'         => new Route($firstCity, $secondCity,
                    Color::white(), Length::four()),
                'length'        => Length::four(),
                'score'         => 7
            ], [
                'lengthName'    => 'five',
                'route'         => new Route($firstCity, $secondCity,
                    Color::white(), Length::five()),
                'length'        => Length::five(),
                'score'         => 10
            ], [
                'lengthName'    => 'six',
                'route'         => new Route($firstCity, $secondCity,
                    Color::white(), Length::six()),
                'length'        => Length::six(),
                'score'         => 15
            ]
        ];
    }
    //#endregion

} //end RouteTest