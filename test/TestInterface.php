<?php
namespace Iggyvolz\Generics\test;
use Iggyvolz\Generics\Generic;
use Iggyvolz\Generics\T1;
use Iggyvolz\Generics\T2;

#[Generic(T1::class, T2::class)]
interface TestInterface
{
    #[T1] public function foo();
    #[T2] public function bar();
}