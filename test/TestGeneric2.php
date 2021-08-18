<?php


namespace Iggyvolz\Generics\test;

use Iggyvolz\Generics\Generic;
use Iggyvolz\Generics\T1;
use Iggyvolz\Generics\T2;

#[Generic(T1::class, T2::class)]
class TestGeneric2
{
    public static function concat(#[T1] $var, #[T2] $var2): string
    {
        return $var . $var2;
    }
}