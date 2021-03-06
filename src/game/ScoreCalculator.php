<?php declare(strict_types=1);
namespace TicketToRide;

final class ScoreCalculator
{
    public function scoreRoute(Route $route): int
    {
        switch ($route->length()->asInteger()) {
            case 1:
                return 1;

            case 2:
                return 2;

            case 3:
                return 4;

            case 4:
                return 7;

            case 5:
                return 10;

            case 6:
                return 15;
        }
    }
}
