<?php declare(strict_types=1);
namespace TicketToRide;

final class Route
{
    /**
     * @var Color
     */
    private $color;

    /**
     * @var Length
     */
    private $length;

    /**
     * @var City
     */
    private $firstCity;

    /**
     * @var City
     */
    private $secondCity;

    public function __construct(City $firstCity, City $secondCity, Color $color, Length $length)
    {
        $this->ensureCitiesAreNotTheSame($firstCity, $secondCity);

        $this->firstCity  = $firstCity;
        $this->secondCity = $secondCity;
        $this->color      = $color;
        $this->length     = $length;
    }

    public function color(): Color
    {
        return $this->color;
    }

    public function length(): Length
    {
        return $this->length;
    }

    public function firstCity(): City
    {
        return $this->firstCity;
    }

    public function secondCity(): City
    {
        return $this->secondCity;
    }

    private function ensureCitiesAreNotTheSame(City $a, City $b): void
    {
        if ($a->name() === $b->name()) {
            throw new InvalidArgumentException;
        }
    }
}
