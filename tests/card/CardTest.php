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
    public function testCanBePurple(): void
    {
        $card = Card::purple();

        $this->assertTrue($card->color()->equalTo(Color::purple()));
    }

    public function testCanBeWhite(): void
    {
        $card = Card::white();

        $this->assertTrue($card->color()->equalTo(Color::white()));
    }

    public function testCanBeBlue(): void
    {
        $card = Card::blue();

        $this->assertTrue($card->color()->equalTo(Color::blue()));
    }

    public function testCanBeYellow(): void
    {
        $card = Card::yellow();

        $this->assertTrue($card->color()->equalTo(Color::yellow()));
    }

    public function testCanBeOrange(): void
    {
        $card = Card::orange();

        $this->assertTrue($card->color()->equalTo(Color::orange()));
    }

    public function testCanBeBlack(): void
    {
        $card = Card::black();

        $this->assertTrue($card->color()->equalTo(Color::black()));
    }

    public function testCanBeRed(): void
    {
        $card = Card::red();

        $this->assertTrue($card->color()->equalTo(Color::red()));
    }

    public function testCanBeGreen(): void
    {
        $card = Card::green();

        $this->assertTrue($card->color()->equalTo(Color::green()));
    }

    public function testCanBeLocomotive(): void
    {
        $card = Card::locomotive();

        $this->assertTrue($card->color()->equalTo(Color::wildcard()));
    }
}
