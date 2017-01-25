NumPhp
================
<!--
[![Build Status](https://travis-ci.org/numphp/numphp.svg?branch=master)](https://travis-ci.org/numphp/numphp)
[![Test Coverage](https://codeclimate.com/github/numphp/numphp/badges/coverage.svg)](https://codeclimate.com/github/numphp/numphp/coverage)
[![Code Climate](https://codeclimate.com/github/numphp/numphp/badges/gpa.svg)](https://codeclimate.com/github/numphp/numphp)
-->

NumPhp is a port of the famous NumPy (Python) package in PHP language.

- Documentation

- Differences between PHP and Python versions.

- Quick Start

- Contribute guide





Usage
-----

### API Methods
```php

require_once 'vendor/autoload.php';

$unit = new NumPhp\NumPhp();

$unit->addScenario([ 'request' => ['path' => '/index.php'] ]);

$unit->assertResponseCode(200);

```
