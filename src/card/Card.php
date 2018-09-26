<?php declare(strict_types=1);
namespace TicketToRide;

final class Card
{
    /**
     * @var Color
     */
    private $color;

    public static function purple(): self
    {
        return new self(Color::purple());
    }

    public static function white(): self
    {
        return new self(Color::white());
    }

    public static function blue(): self
    {
        return new self(Color::blue());
    }

    public static function yellow(): self
    {
        return new self(Color::yellow());
    }

    public static function orange(): self
    {
        return new self(Color::orange());
    }

    public static function black(): self
    {
        return new self(Color::black());
    }

    public static function red(): self
    {
        return new self(Color::red());
    }

    public static function green(): self
    {
        return new self(Color::green());
    }

    public static function locomotive(): self
    {
        return new self(Color::wildcard());
    }

    private function __construct(Color $color)
    {
        $this->color = $color;
    }

    public function color(): Color
    {
        return $this->color;
    }
}
