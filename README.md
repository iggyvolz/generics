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

Yes, « and » are valid in PHP class names.
