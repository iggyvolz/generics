<?php

namespace Iggyvolz\Generics;

use LogicException;

abstract class GenericClass
{
    // Stores the current class name (a stack)
    private static array $className = [];
    public static function class(): string
    {
        if(empty(self::$className)) {
            throw new LogicException("Cannot use GenericClass::class() outside of a generic class");
        }
        return self::$className[array_key_last(self::$className)];
    }
    public static function push(string $name): void
    {
        self::$className[] = $name;
    }
    public static function pop(): void
    {
        array_pop(self::$className);
    }
}