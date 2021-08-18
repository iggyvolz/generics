<?php

use Iggyvolz\Generics\ImplementationGenerator;
use Iggyvolz\Generics\test\TestGeneric2«int‚string»;
use Iggyvolz\Generics\test\TestGeneric«int»;
use Iggyvolz\Generics\test\TestGeneric«DeezNuts\Ha\GotEm» as TestGeneric«GotEm»;
use Tester\Assert;

require_once __DIR__ . "/TestGeneric.php";
require_once __DIR__ . "/TestGeneric2.php";
require_once __DIR__ . "/../vendor/autoload.php";
Tester\Environment::setup();
ImplementationGenerator::setMode(ImplementationGenerator::MODE_DEBUG);
ImplementationGenerator::register();
$x = new TestGeneric«int»();
Assert::same(69, $x->foo(69));
Assert::same("int", (new ReflectionClass(TestGeneric«int»::class))->getMethod("foo")->getReturnType()?->getName());
Assert::same("int", (new ReflectionClass(TestGeneric«int»::class))->getMethod("foo")->getParameters()[0]->getType()?->getName());
Assert::same(420, $x->add(421, -1));
Assert::same("2abc", TestGeneric2«int‚string»::concat(2,"abc"));
Assert::same("DeezNuts\\Ha\\GotEm", TestGeneric«GotEm»::whatsmytype());