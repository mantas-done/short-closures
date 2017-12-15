## Short Closure syntax for PHP ##

Currently PHP doesn't support short closures natively. But what if we could use it today?

```php
// instead of this code:
$totalRevenue = $employees
    ->filter(function ($employee) {
        return $employee->district == 'Amsterdam';
    })->flatMap(function ($employee) {
        return $employee->customers;
    })->map(function ($customer) {
        return $customer->orders->sum('total');
    })->filter(function ($customerTotal) {
        return $customerTotal >= 75000;
    })->sum();

// you can do:
$totalRevenue = $employees
    ->filter('$employee->district == "Amsterdam"')
    ->flatMap('$employee->customers')
    ->map('$customer->orders->sum("total")')
    ->filter('$customerTotal >= 75000')
    ->sum();
```

How it works? This library has a function that converts string to regular PHP anonymous function.

```php
// instead of this code:
$anonymous_function = function ($x) {
   return $x * 2;
}

// you can do:
$anonymous_function = c('$x ~> $x * 2');

// or even shorter:
$anonymous_function = c('$x * 2');


// usage 
echo $anonymous_function(3); // output: 6
```

## Instalation ##

```
composer require mantas-done/short-closure
```

## Syntax ##

```php
// all this syntax is valid
c('$x * 2');
c('$x ~> $x * 2');
c('($x) ~> $x * 2');
c('$x ~> {return $x * 2;}');
c('($x) ~> {return $x * 2;}');
c('($v, $k) ~> $v == 2 && $k == 1');
c('($v, $k) ~> {return $v == 2 && $k == 1;}');
c('($v, $k) ~> {$v2 = $v * 2; $k2 = $k * 2; return $v2 == 4 && $k2 == 2;}');
```

## Usage ##

This package can be used in any project, but the biggest advantage would be achieved if it would be tightly integrated into other packages.  
For example if it would be integrated into Laravel Collection package, c() function call could be removed.  
Currently you can use c() helper to convert your strings to closure:

```php
$totalRevenue = $employees
    ->filter(c('$employee->district == "Amsterdam"'))
    ->flatMap(c('$employee->customers'))
    ->map(c('$customer->orders->sum("total")'))
    ->filter(c('$customerTotal >= 75000'))
    ->sum();
```

Or you can replace your Laravel Collection class with provided CollectionWithShortClosure class. Then you can write code without c() helper.  
CollectionWithShortClosure can be used only with PHP 7.2 or above.

```php
$totalRevenue = $employees
    ->filter('$employee->district == "Amsterdam"')
    ->flatMap('$employee->customers')
    ->map('$customer->orders->sum("total")')
    ->filter('$customerTotal >= 75000')
    ->sum();
```

Short closures could be integrated into Laravel Eloquent. But I don't provide this integration.
```php
// instead of this code:
$users = User::whereHas('comments', function ($q) {
    $q->published();
})->get();

// it could be replaced with:
$users = User::whereHas('comments', 'published()')->get();

// ofcouse you can use it without tight integration, but it doesn't look nice
$users = User::whereHas('comments', c('$q->published()'))->get();
```

## Other ##

More info about PHP short closures https://wiki.php.net/rfc/short_closures

