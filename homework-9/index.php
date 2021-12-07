<?php
namespace Army;

spl_autoload_register(function ($class)
{
	include __DIR__ . '/' . str_replace("\\", "/", $class) . '.php';
});

$calculatePower = static function ($sum, $warrior)
{
	$sum += $warrior->power();
	return $sum;
};

$armyA = [];
$armyB = [];

$forges = [
	'archer',
	'horseman',
];

for ($i = 0; $i < 100; $i++)
{
	$armyA[] = \Army\Helper::getForge($forges[rand(0, 1)])->createWarrior();
	$armyB[] = \Army\Helper::getForge($forges[rand(0, 1)])->createWarrior();
}
$armyPowerA = array_reduce($armyA, $calculatePower);
$armyPowerB = array_reduce($armyB, $calculatePower);

echo $armyPowerA, PHP_EOL;
echo $armyPowerB, PHP_EOL;

$romeFactory = new \Army\Rome\RomeArmyForge();
var_dump($romeFactory->createArcher());
var_dump($romeFactory->createHorseman());

$barbarianFactory = new \Army\Barbarian\BarbarianArmyForge();
var_dump($barbarianFactory->createArcher()->power());
var_dump($barbarianFactory->createHorseman());

// $barbarianBow = new \Army\Weapon\Bows\BowForge();
// var_dump($barbarianBow->createBarbarianBow());

// $build = new \Army\Builder\ArcherBuilder();
//
// var_dump(\Army\Builder\Director::build($build));
//
// $build->addLeftHandArmor()->getWarrior();

$barbarianBow = new \Army\Weapon\Bows\BarbarianBow();
var_dump($barbarianBow->damage());

$romeKnife = new \Army\Weapon\Knifes\RomeKnife();
var_dump($romeKnife->damage());