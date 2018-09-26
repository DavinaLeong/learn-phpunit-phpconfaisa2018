<?php declare(strict_types=1);
namespace TicketToRide;

final class RouteClaimChecker
{
    public function canClaimRoute(Route $route, CardCollection $cards): bool
    {
        if ($route->length()->asInteger() !== \count($cards)) {
            return false;
        }

        if ($cards->numberOfDifferentColors() > 1) {
            return false;
        }

        foreach ($cards as $card) {
            if (!$card->color()->matches($route->color())) {
                return false;
            }
        }

        return true;
    }
}
