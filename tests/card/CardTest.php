<?php declare(strict_types=1);
namespace TicketToRide;

use PHPUnit\Framework\TestCase;

/**
 * @covers \TicketToRide\Card
 *
 * @uses \TicketToRide\Color
 */
final class CardTest extends TestCase
{
    /**
     * @dataProvider cardColorProvider
     */
    public function testCanHaveColor(Color $color, Card $card): void
    {
        $expected   = $color->asString();
        $actual     = $card->color()->asString();
        $this->assertEquals($expected, $actual);
    }

    public function cardColorProvider(): array
    {
        return [
            'purple'    => [
                Color::purple(),
                Card::purple()
            ],
            'white'     => [
                Color::white(),
                Card::white()
            ],
            'blue'      => [
                Color::blue(),
                Card::blue()
            ],
            'yellow'    => [
                Color::yellow(),
                Card::yellow()
            ],
            'orange'    => [
                Color::orange(),
                Card::orange()
            ],
            'black'     => [
                Color::black(),
                Card::black()
            ],
            'red'       => [
                Color::red(),
                Card::red()
            ],
            'green'     => [
                Color::green(),
                Card::green()
            ],
            'wildcard'  => [
                Color::wildcard(),
                Card::locomotive()
            ]
        ];
    }

} //end CardTes
