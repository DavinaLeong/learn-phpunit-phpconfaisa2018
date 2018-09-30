<?php declare(strict_types=1);
namespace TicketToRide;

use PHPUnit\Framework\TestCase;

/**
 * @covers \TicketToRide\ScoreCalculator
 * 
 * @uses \TicketToRide\City
 * @uses \TicketToRide\Color
 * @uses \TicketToRide\Length
 * @uses \TicketToRide\Route
 */
final class ScoreCalculatorTest extends TestCase
{
    // === Tests ==============================================================
    /**
     * @dataProvider routeScoreProvider
     */
    public function testCalculateScore(int $score, Route $route): void
    {
        $calculator = new ScoreCalculator();

        $expected   = $score;
        $actual     = $calculator->scoreRoute($route);
        $this->assertEquals($expected, $actual);
    }
    
    
    // === Data Providers =====================================================
    public function routeScoreProvider(): array
    {
        $firstCity  = new City("Hello City");
        $secondCity = new City("Hello Metropolis");

        /* Structure:
         * [dataset name] => [
         *      0 => expected score of route
         *      1 => Route
         * ]
         */
        $data = [
            'Length: 1 | Score: 1'  => [
                1,
                new Route($firstCity, $secondCity, Color::white(),
                    Length::one())
            ],
            'Length: 2 | Score: 2'  => [
                2,
                new Route($firstCity, $secondCity, Color::white(),
                    Length::two())
            ],
            'Length: 3 | Score: 4'  => [
                4,
                new Route($firstCity, $secondCity, Color::white(),
                    Length::three())
            ],
            'Length: 4 | Score: 7'  => [
                7,
                new Route($firstCity, $secondCity, Color::white(),
                    Length::four())
            ],
            'Length: 5 | Score: 10' => [
                10,
                new Route($firstCity, $secondCity, Color::white(),
                    Length::five())
            ],
            'Length: 6 | Score: 15' => [
                15,
                new Route($firstCity, $secondCity, Color::white(),
                    Length::six())
            ]
        ];

        return $data;
    }

} //end ScoreCalculatorTest