<?php declare(strict_types=1);
namespace TicketToRide;

final class CardCollectionIterator implements \Iterator
{
    /**
     * @var Card[]
     */
    private $cards;

    /**
     * @var int
     */
    private $position;

    public function __construct(CardCollection $cards)
    {
        $this->cards = $cards->asArray();
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function valid(): bool
    {
        return $this->position < \count($this->cards);
    }

    public function key(): int
    {
        return $this->position;
    }

    public function current(): Card
    {
        return $this->cards[$this->position];
    }

    public function next(): void
    {
        $this->position++;
    }
}
