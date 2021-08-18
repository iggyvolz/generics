<?php

use Iggyvolz\Generics\ImplementationGenerator;
use Iggyvolz\Generics\test\TestGeneric«int»;
use Tester\Assert;

require_once __DIR__ . "/TestGeneric.php";
require_once __DIR__ . "/../vendor/autoload.php";
Tester\Environment::setup();
ImplementationGenerator::setMode(ImplementationGenerator::MODE_DEBUG);
ImplementationGenerator::register();
$x = new TestGeneric«int»();
Assert::same(69, $x->foo(69));
Assert::same("int", (new ReflectionClass(TestGeneric«int»::class))->getMethod("foo")->getReturnType()?->getName());
Assert::same("int", (new ReflectionClass(TestGeneric«int»::class))->getMethod("foo")->getParameters()[0]->getType()?->getName());
