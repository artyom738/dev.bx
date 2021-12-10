<?php

spl_autoload_register(function ($class) {
	include __DIR__ . '/' . str_replace("\\", "/",  $class) . '.php';
});


$advertisement = (new \Entity\Advertisement())
	->setBody("Advertisement Text")
	->setTitle("test")
	->setDuration(10);

$calculator = new \Service\AdvCalculator($advertisement);
$calculator->applyCost();

$calculator = new \Decorator\VatCostDecorator($calculator);
// var_dump($calculator->applyCost()->getTotalCost());

$headerFooterAdder = new \Decorator\HeaderFooterDecorator($advertisement);
$headerFooterAdder->addHeaderFooter();

var_dump($headerFooterAdder->getMessage());
