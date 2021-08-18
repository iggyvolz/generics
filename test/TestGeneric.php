<?php


namespace Iggyvolz\Generics\test;

use Iggyvolz\Generics\Generic;
use Iggyvolz\Generics\T1;

#[Generic(T1::class)]
class TestGeneric
{
    #[T1] public function foo(#[T1] $var)
    {
        return $var;
    }
}