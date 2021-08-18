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
    #[T1] public function add(#[T1] $var, #[T1] $var2)
    {
        return $var + $var2;
    }
}