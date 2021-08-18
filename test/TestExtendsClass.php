<?php

namespace Iggyvolz\Generics\test;

use Iggyvolz\Generics\ExtendsGeneric;
use Iggyvolz\Generics\Generic;
use Iggyvolz\Generics\T1;

#[Generic(T1::class)]
#[ExtendsGeneric(TestImplementsInterface::class, T1::class)]
class TestExtendsClass
{
}