<?php

namespace Iggyvolz\Generics;
// Used for complex return or param types
// TODO make this a reasonable name
#[\Attribute]
class IsGeneric
{

    /**
     * @var class-string[]
     */
    public /* readonly */ array $generics;

    /**
     * @param class-string ...$generics
     */
    public function __construct(
        public /* readonly */ string $class,
        string ...$generics
    )
    {
        $this->generics = $generics;
    }
}