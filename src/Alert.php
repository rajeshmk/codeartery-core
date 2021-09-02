<?php

namespace CodeArtery\Core;

use CodeArtery\Core\Alert\AlertMessage;
use Exception;

class Alert
{
    private static array $alerts = [];

    public static function __callStatic($name, $arguments): AlertMessage
    {
        if (! in_array($name, ['success', 'info', 'warning', 'danger'])) {
            throw new Exception('Bad method call: `' . $name . '(...)`');
        }

        return self::alert($name, ...$arguments);
    }

    public static function alert(string $type, string $message): AlertMessage
    {
        self::$alerts[] = $alert = new AlertMessage($message, $type);

        return $alert;
    }

    public static function all(string $cast = 'array'): array
    {
        $bag = [];
        foreach (self::$alerts as $alert) {
            $bag[] = match($cast) {
                'html', 'bootstrap' => $alert->bootstrap(),
                'array', 'json' => $alert->toArray(),
                default => throw new Exception('Casting to ' . $cast . ' is not permitted!'),
            };
        }

        return $bag;
    }
}
