<?php declare(strict_types=1);
// @codingStandardsIgnoreFile
// @codeCoverageIgnoreStart
// this is an autogenerated file - do not edit
\spl_autoload_register(
    function ($class): void {
        static $classes = null;

        if ($classes === null) {
            $classes = [
                'tickettoride\\card'                     => '/card/Card.php',
                'tickettoride\\cardcollection'           => '/card/CardCollection.php',
                'tickettoride\\cardcollectioniterator'   => '/card/CardCollectionIterator.php',
                'tickettoride\\city'                     => '/route/City.php',
                'tickettoride\\color'                    => '/color/Color.php',
                'tickettoride\\exception'                => '/exceptions/Exception.php',
                'tickettoride\\invalidargumentexception' => '/exceptions/InvalidArgumentException.php',
                'tickettoride\\length'                   => '/route/Length.php',
                'tickettoride\\route'                    => '/route/Route.php',
                'tickettoride\\routeclaimchecker'        => '/game/RouteClaimChecker.php',
                'tickettoride\\scorecalculator'          => '/game/ScoreCalculator.php'
            ];
        }
        $cn = \strtolower($class);

        if (isset($classes[$cn])) {
            require __DIR__ . $classes[$cn];
        }
    },
    true,
    false
);
// @codeCoverageIgnoreEnd
