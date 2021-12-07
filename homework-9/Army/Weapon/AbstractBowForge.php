<?php

namespace Army\Weapon;

abstract class AbstractBowForge
{
	abstract public function createBarbarianBow(): Bow;
	abstract public function createRomeBow(): Bow;
}