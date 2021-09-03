<?php

namespace CodeArtery\Core\Support;

use ArrayAccess;

abstract class Collection implements ArrayAccess
{
    abstract public function all(string $cast = 'array'): array;

    public function __construct(protected array $items = [])
    {
        //
    }

    public function offsetSet($key, $value)
    {
        if (is_null($key)) {
            $this->items[] = $value;
        } else {
            $this->items[$key] = $value;
        }
    }

    public function offsetExists($key)
    {
        return isset($this->items[$key]);
    }

    public function offsetUnset($key)
    {
        unset($this->items[$key]);
    }

    public function offsetGet($key)
    {
        return $this->items[$key] ?? null;
    }

    public function count()
    {
        return count($this->items);
    }
}
