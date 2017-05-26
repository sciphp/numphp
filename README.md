NumPhp [![Build Status](https://travis-ci.org/sciphp/numphp.svg?branch=master)](https://travis-ci.org/sciphp/numphp) [![Test Coverage](https://codeclimate.com/github/sciphp/numphp/badges/coverage.svg)](https://codeclimate.com/github/sciphp/numphp/coverage) [![Code Climate](https://codeclimate.com/github/sciphp/numphp/badges/gpa.svg)](https://codeclimate.com/github/sciphp/numphp)
======

NumPhp is a port of the famous NumPy (Python) package in PHP language.

- [Documentation](http://sciphp.org)
- [Code coverage](http://sciphp.org/coverage/)
- [API](http://sciphp.org/api/)

________________________________________________________________________

## Install

```
composer require sciphp/numphp
```
________________________________________________________________________

## Quick usage

```php
use SciPhp\NumPhp as np;

$m = np::ar(
  [[ 1, 0, 0],
   [ 0, 1, 0],
   [ 0, 0, 1]]
)->dot(42);

echo "m.42 =\n$m";

```
will output:

```
m.42 =
[[ 42,  0,  0 ],
 [  0, 42,  0 ],
 [  0,  0, 42 ]]
```
