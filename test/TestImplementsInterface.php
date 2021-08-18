<?php

namespace Iggyvolz\Generics\test;

use Iggyvolz\Generics\Generic;
use Iggyvolz\Generics\ImplementsGeneric;
use Iggyvolz\Generics\T1;

#[Generic(T1::class)]
#[ImplementsGeneric(TestInterface::class, "int", T1::class)]
class TestImplementsInterface
{
    public function foo(): int
    {
        return 1;
    }
    #[T1]
    public function bar()
    {
        $class = T1::class();
        return new $class;
    }
}