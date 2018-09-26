<?php declare(strict_types=1);
namespace TicketToRide;

final class Length
{
    /**
     * @var int
     */
    private $length;

    public static function one(): self
    {
        return new self(1);
    }

    public static function two(): self
    {
        return new self(2);
    }

    public static function three(): self
    {
        return new self(3);
    }

    public static function four(): self
    {
        return new self(4);
    }

    public static function five(): self
    {
        return new self(5);
    }

    public static function six(): self
    {
        return new self(6);
    }

    private function __construct(int $length)
    {
        $this->length = $length;
    }

    public function asInteger(): int
    {
        return $this->length;
    }

    public function equalTo(self $other): bool
    {
        return $this->length === $other->asInteger();
    }
}
