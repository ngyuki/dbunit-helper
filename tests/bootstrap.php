<?php
$loader = require __DIR__ . '/../vendor/autoload.php';
$loader->addPsr4('Tests\\', __DIR__);
$reflection = new ReflectionClass('PHPUnit_Framework_Assert');
require_once dirname($reflection->getFileName()) . '/Assert/Functions.php';
