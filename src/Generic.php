<?php


namespace Iggyvolz\Generics;

use Attribute;

#[Attribute]
class Generic
{
    /**
     * @var class-string<GenericClass>[]
     */
    public /* readonly */ array $classes;

    /**
     * @param class-string<GenericClass> ...$classes
     */
    public function __construct(
        string ...$classes
    )
    {
        $this->classes = $classes;
    }
}