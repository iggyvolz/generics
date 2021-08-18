<?php

namespace Iggyvolz\Generics;
#[\Attribute]
class ExtendsGeneric
{

    /**
     * @var class-string[]
     */
    public /* readonly */ array $generics;

    /**
     * @param class-string ...$classes
     */
    public function __construct(
        public /* readonly */ string $extends,
        string ...$generics
    )
    {
        $this->generics = $generics;
    }
}