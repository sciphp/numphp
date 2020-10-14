NumPhp [![Build Status](https://travis-ci.org/sciphp/numphp.svg?branch=master)](https://travis-ci.org/sciphp/numphp) [![Test Coverage](https://codeclimate.com/github/sciphp/numphp/badges/coverage.svg)](https://codeclimate.com/github/sciphp/numphp/coverage) [![Code Climate](https://codeclimate.com/github/sciphp/numphp/badges/gpa.svg)](https://codeclimate.com/github/sciphp/numphp)
======

NumPhp is a port of the famous NumPy (Python) package in PHP language.

- [Documentation](http://sciphp.org)
- [Code coverage](http://sciphp.org/coverage/)
- [API](http://sciphp.org/api/)

Table of contents
=================

- [Requirements](#requirements)
- [Installation](#install)
- [Basic Usage](#basic-usage)
- [Documentation](#documentation)
    - [NdArray attributes](#ndarray-attributes)
    - [NdArray methods](#ndarray-methods)
    - [NumPhp methods](#numphp-methods)
- [Contributing](#contributing)

________________________________________________________________________

Requirements
------------

NumPhp supports PHP 7.2, 7.3 7.4 and 8.0.

________________________________________________________________________

Install
-------

```
composer require sciphp/numphp
```
________________________________________________________________________

Basic usage
--------------

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

________________________________________________________________________

Documentation
-------------

### NdArray attributes

- [NdArray::data](https://sciphp.org/manual/en/ndarray.data.html)
- [NdArray::ndim](https://sciphp.org/manual/en/ndarray.ndim.html)
- [NdArray::shape](https://sciphp.org/manual/en/ndarray.shape.html)
- [NdArray::size](https://sciphp.org/manual/en/ndarray.size.html)
- [NdArray::T](https://sciphp.org/manual/en/ndarray.T.html)

________________________________________________________________________

### NdArray methods

- [NdArray::copy](https://sciphp.org/manual/en/ndarray.copy.html)
- [NdArray::negative](https://sciphp.org/manual/en/ndarray.negative.html)
- [NdArray::ravel](https://sciphp.org/manual/en/ndarray.ravel.html)
- [NdArray::reshape](https://sciphp.org/manual/en/ndarray.reshape.html)
- [NdArray::resize](https://sciphp.org/manual/en/ndarray.resize.html)
- [NdArray::add](https://sciphp.org/manual/en/ndarray.add.html)
- [NdArray::divide](https://sciphp.org/manual/en/ndarray.divide.html)
- [NdArray::dot](https://sciphp.org/manual/en/ndarray.dot.html)
- [NdArray::multiply](https://sciphp.org/manual/en/ndarray.multiply.html)
- [NdArray::reciprocal](https://sciphp.org/manual/en/ndarray.reciprocal.html)
- [NdArray::subtract](https://sciphp.org/manual/en/ndarray.subtract.html)
- [NdArray::sum](https://sciphp.org/manual/en/ndarray.sum.html)
- [NdArray::trace](https://sciphp.org/manual/en/ndarray.trace.html)
- [NdArray::trapz](https://sciphp.org/manual/en/ndarray.trapz.html)
- [NdArray::log](https://sciphp.org/manual/en/ndarray.log.html)
- [NdArray::log10](https://sciphp.org/manual/en/ndarray.log10.html)
- [NdArray::log2](https://sciphp.org/manual/en/ndarray.log2.html)
- [NdArray::exp](https://sciphp.org/manual/en/ndarray.exp.html)
- [NdArray::expm1](https://sciphp.org/manual/en/ndarray.expm1.html)
- [NdArray::exp2](https://sciphp.org/manual/en/ndarray.exp2.html)
- [NdArray::power](https://sciphp.org/manual/en/ndarray.power.html)
- [NdArray::sqrt](https://sciphp.org/manual/en/ndarray.sqrt.html)
- [NdArray::square](https://sciphp.org/manual/en/ndarray.square.html)
- [NdArray::tril](https://sciphp.org/manual/en/ndarray.tril.html)
- [NdArray::triu](https://sciphp.org/manual/en/ndarray.triu.html)
- [NdArray::copysign](https://sciphp.org/manual/en/ndarray.copysign.html)
- [NdArray::signbit](https://sciphp.org/manual/en/ndarray.signbit.html)
- [NdArray::vander](https://sciphp.org/manual/en/ndarray.vander.html)
- [NdArray::is_square](https://sciphp.org/manual/en/ndarray.is_square.html)

________________________________________________________________________

### NumPhp methods

- [NumPhp::ar](https://sciphp.org/manual/en/numphp.ar.html)
- [NumPhp::full](https://sciphp.org/manual/en/numphp.full.html)
- [NumPhp::nulls](https://sciphp.org/manual/en/numphp.nulls.html)
- [NumPhp::ones](https://sciphp.org/manual/en/numphp.ones.html)
- [NumPhp::zeros](https://sciphp.org/manual/en/numphp.zeros.html)
- [NumPhp::full_like](https://sciphp.org/manual/en/numphp.full_like.html)
- [NumPhp::nulls_like](https://sciphp.org/manual/en/numphp.nulls_like.html)
- [NumPhp::zeros_like](https://sciphp.org/manual/en/numphp.zeros_like.html)
- [NumPhp::arange](https://sciphp.org/manual/en/numphp.arange.html)
- [NumPhp::linspace](https://sciphp.org/manual/en/numphp.linspace.html)
- [NumPhp::logspace](https://sciphp.org/manual/en/numphp.logspace.html)
- [NumPhp::loadtxt](https://sciphp.org/manual/en/numphp.loadtxt.html)
- [NumPhp::diag](https://sciphp.org/manual/en/numphp.diag.html)
- [NumPhp::diagflat](https://sciphp.org/manual/en/numphp.diagflat.html)
- [NumPhp::diagonal](https://sciphp.org/manual/en/numphp.diagonal.html)
- [NumPhp::eye](https://sciphp.org/manual/en/numphp.eye.html)
- [NumPhp::negative](https://sciphp.org/manual/en/numphp.negative.html)
- [NumPhp::identity](https://sciphp.org/manual/en/numphp.identity.html)
- [NumPhp::trace](https://sciphp.org/manual/en/numphp.trace.html)
- [NumPhp::tri](https://sciphp.org/manual/en/numphp.tri.html)
- [NumPhp::tril](https://sciphp.org/manual/en/numphp.tril.html)
- [NumPhp::triu](https://sciphp.org/manual/en/numphp.triu.html)
- [NumPhp::vander](https://sciphp.org/manual/en/numphp.vander.html)
- [NumPhp::add](https://sciphp.org/manual/en/numphp.add.html)
- [NumPhp::divide](https://sciphp.org/manual/en/numphp.divide.html)
- [NumPhp::dot](https://sciphp.org/manual/en/numphp.dot.html)
- [NumPhp::multiply](https://sciphp.org/manual/en/numphp.multiply.html)
- [NumPhp::power](https://sciphp.org/manual/en/numphp.power.html)
- [NumPhp::sqrt](https://sciphp.org/manual/en/numphp.sqrt.html)
- [NumPhp::square](https://sciphp.org/manual/en/numphp.square.html)
- [NumPhp::reciprocal](https://sciphp.org/manual/en/numphp.reciprocal.html)
- [NumPhp::subtract](https://sciphp.org/manual/en/numphp.subtract.html)
- [NumPhp::transpose](https://sciphp.org/manual/en/numphp.transpose.html)
- [NumPhp::sum](https://sciphp.org/manual/en/numphp.sum.html)
- [NumPhp::trapz](https://sciphp.org/manual/en/numphp.trapz.html)
- [NumPhp::log](https://sciphp.org/manual/en/numphp.log.html)
- [NumPhp::log10](https://sciphp.org/manual/en/numphp.log10.html)
- [NumPhp::log2](https://sciphp.org/manual/en/numphp.log2.html)
- [NumPhp::exp](https://sciphp.org/manual/en/numphp.exp.html)
- [NumPhp::expm1](https://sciphp.org/manual/en/numphp.expm1.html)
- [NumPhp::exp2](https://sciphp.org/manual/en/numphp.exp2.html)
- [NumPhp::signbit](https://sciphp.org/manual/en/numphp.signbit.html)
- [NumPhp::copysign](https://sciphp.org/manual/en/numphp.copysign.html)
- [NumPhp::broadcast_to](https://sciphp.org/manual/en/numphp.broadcast_to.html)
- [NumPhp::is_square](https://sciphp.org/manual/en/numphp.is_square.html)

________________________________________________________________________


In the [complete documentation](http://sciphp.org), you will find all implemented stuff
including some [Linear Algebra methods](https://sciphp.org/manual/en/ref.linalg.html)
like [matrix norms](https://sciphp.org/manual/en/linalg.norm.html)
and [Cholesky transformation](https://sciphp.org/manual/en/linalg.cholesky.html).


________________________________________________________________________

Contributing
------------

Feel free to open issues and make PR. Contributions are welcome.

If you find a mistake or think an example is missing in the documentation,
it's hosted on [numphp-doc](https://github.com/sciphp/numphp-doc)
repository.
