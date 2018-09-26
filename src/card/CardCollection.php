<?php declare(strict_types=1);
namespace TicketToRide;

final class CardCollection implements \Countable, \IteratorAggregate
{
    /**
     * @var Card[]
     */
    private $cards = [];

    public static function fromCards(Card ...$cards): self
    {
        $collection = new self;

        foreach ($cards as $card) {
            $collection->add($card);
        }

        return $collection;
    }

    public function add(Card $card): void
    {
        $this->cards[] = $card;
    }

    /**
     * @return Card[]
     */
    public function asArray(): array
    {
        return $this->cards;
    }

    public function count(): int
    {
        return \count($this->cards);
    }

    public function getIterator(): CardCollectionIterator
    {
        return new CardCollectionIterator($this);
    }

    public function numberOfDifferentColors(): int
    {
        $colors = [];

        foreach ($this->cards as $card) {
            if ($card->color()->asString() === 'wildcard') {
                continue;
            }

            $colors[] = $card->color()->asString();
        }

        return \count(\array_unique($colors));
    }
}
