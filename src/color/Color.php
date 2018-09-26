<?php declare(strict_types=1);
namespace TicketToRide;

final class Color
{
    /**
     * @var string
     */
    private $color;

    public static function purple(): self
    {
        return new self('purple');
    }

    public static function white(): self
    {
        return new self('white');
    }

    public static function blue(): self
    {
        return new self('blue');
    }

    public static function yellow(): self
    {
        return new self('yellow');
    }

    public static function orange(): self
    {
        return new self('orange');
    }

    public static function black(): self
    {
        return new self('black');
    }

    public static function red(): self
    {
        return new self('red');
    }

    public static function green(): self
    {
        return new self('green');
    }

    public static function wildcard(): self
    {
        return new self('wildcard');
    }

    private function __construct(string $color)
    {
        $this->color = $color;
    }

    public function asString(): string
    {
        return $this->color;
    }

    public function equalTo(self $other): bool
    {
        return $this->color === $other->asString();
    }

    public function matches(self $other): bool
    {
        if ($this->isPurple() && $other->isPurple()) {
            return true;
        }

        if ($this->isWhite() && $other->isWhite()) {
            return true;
        }

        if ($this->isBlue() && $other->isBlue()) {
            return true;
        }

        if ($this->isYellow() && $other->isYellow()) {
            return true;
        }

        if ($this->isOrange() && $other->isOrange()) {
            return true;
        }

        if ($this->isBlack() && $other->isBlack()) {
            return true;
        }

        if ($this->isRed() && $other->isRed()) {
            return true;
        }

        if ($this->isGreen() && $other->isGreen()) {
            return true;
        }

        return false;
    }

    public function isPurple(): bool
    {
        return $this->color === 'purple' || $this->color === 'wildcard';
    }

    public function isWhite(): bool
    {
        return $this->color === 'white' || $this->color === 'wildcard';
    }

    public function isBlue(): bool
    {
        return $this->color === 'blue' || $this->color === 'wildcard';
    }

    public function isYellow(): bool
    {
        return $this->color === 'yellow' || $this->color === 'wildcard';
    }

    public function isOrange(): bool
    {
        return $this->color === 'orange' || $this->color === 'wildcard';
    }

    public function isBlack(): bool
    {
        return $this->color === 'black' || $this->color === 'wildcard';
    }

    public function isRed(): bool
    {
        return $this->color === 'red' || $this->color === 'wildcard';
    }

    public function isGreen(): bool
    {
        return $this->color === 'green' || $this->color === 'wildcard';
    }
}
