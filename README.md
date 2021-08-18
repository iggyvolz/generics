# generics
Generics in PHP using classgen

```php
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
```

Can be used as:
```php
$x = new TestGeneric«int»();
```

Which generates:
```php
<?php
namespace Iggyvolz\Generics\test;

#[\Iggyvolz\Generics\Generic('Iggyvolz\Generics\T1')]
class TestGeneric«int»
{
	#[\Iggyvolz\Generics\T1]
	public function foo(#[\Iggyvolz\Generics\T1] int $var): int
	{
		try {'Iggyvolz\\Generics\\T1'::push('int');return $var;
		} finally {'Iggyvolz\\Generics\\T1'::pop();}
	}
}

```

Multiple parameters can be passed:
```php
#[Generic(T1::class, T2::class)]
class TestGeneric2
{
    public static function concat(#[T1] $var, #[T2] $var2): string
    {
        return $var . $var2;
    }
}
```
Generates:
```php
class TestGeneric2«int‚string»
{
	public static function concat(
		#[\Iggyvolz\Generics\T1] int $var,
		#[\Iggyvolz\Generics\T2] string $var2,
	): string {
		try {'Iggyvolz\\Generics\\T1'::push('int');'Iggyvolz\\Generics\\T2'::push('string');return $var . $var2;
		} finally {'Iggyvolz\\Generics\\T1'::pop();'Iggyvolz\\Generics\\T2'::pop();}
	}
}
```

Yes, « and » and ‚ are valid in PHP class names.  No that's not a comma (0x2C) but a "single low-9 quotation mark" (x82) which is valid for PHP class names.
