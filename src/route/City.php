<?php declare(strict_types=1);
namespace TicketToRide;

final class City
{
    /**
     * @var string
     */
    private $name;

    public function __construct(string $name)
    {
        $this->ensureNameIsValid($name);

        $this->name = $name;
    }

    public function name(): string
    {
        return $this->name;
    }

    private function ensureNameIsValid(string $name): void
    {
        if (empty(\trim($name))) {
            throw new InvalidArgumentException;
        }
    }
}
