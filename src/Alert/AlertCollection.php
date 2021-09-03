<?php

namespace CodeArtery\Core\Alert;

use CodeArtery\Core\Exception\ArteryException;
use CodeArtery\Core\Support\Collection;

class AlertCollection extends Collection
{
    public function all(string $cast = 'array'): array
    {
        $bag = [];
        foreach ($this->items as $alert) {
            $bag[] = match($cast) {
                'html', 'bootstrap' => $alert->bootstrap(),
                'array', 'json' => $alert->toArray(),
                default => throw new ArteryException('Casting to ' . $cast . ' is not permitted!'),
            };
        }

        return $bag;
    }
}
