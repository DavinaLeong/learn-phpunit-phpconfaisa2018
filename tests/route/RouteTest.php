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
    public function testRouteHasColor(Color $color, Route $route): void
    {
        $expected   = $color;
        $actual     = $route->color();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider routeLengthProvider
     */
    public function testRouteHasLength(Length $length, Route $route): void
    {
        $expected   = $length->asInteger();
        $actual     = $route->length()->asInteger();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @dataProvider routeClaimableProvider
     */
    public function testRouteIsClaimable($expected, $actual): void
    {
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

        $routeCards = [
            'Claimable - same-colored cards' => [
                new Route($firstCity, $secondCity,
                    Color::white(), Length::two()),
                'cards' => [ Card::white(), Card::white() ],
                'claimable' => true
            ],
            'Claimable - wildcards cards' => [
                new Route($firstCity, $secondCity,
                    Color::white(), Length::two()),
                'cards' => [ Card::locomotive(), Card::locomotive() ],
                'claimable' => true
            ],
            'Claimable - one wildcard, one same-colored' => [
                new Route($firstCity, $secondCity,
                    Color::white(), Length::two()),
                'cards' => [ Card::locomotive(), Card::white() ],
                'claimable' => true
            ],
            'Not Claimable - different-colored cards' => [
                new Route($firstCity, $secondCity,
                    Color::white(), Length::two()),
                'cards' => [ Card::white(), Card::red() ],
                'claimable' => false
            ],
            'Not Claimable - insufficient cards' => [
                new Route($firstCity, $secondCity,
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