<?php

namespace Iggyvolz\Generics;
#[\Attribute(\Attribute::TARGET_ALL |\Attribute::IS_REPEATABLE)]
class ImplementsGeneric
{

    /**
     * @var class-string[]
     */
    public /* readonly */ array $generics;

    /**
     * @param class-string ...$classes
     */
    public function __construct(
        public /* readonly */ string $implements,
        string ...$generics
    )
    {
        $this->generics = $generics;
    }
}