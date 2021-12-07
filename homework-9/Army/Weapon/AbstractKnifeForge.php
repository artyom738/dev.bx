<?php

namespace Army\Weapon;

abstract class AbstractKnifeForge
{
	abstract public function createBarbarianKnife(): Knife;
	abstract public function createRomeKnife(): Knife;
}