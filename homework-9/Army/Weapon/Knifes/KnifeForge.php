<?php

namespace Army\Weapon\Knifes;
use Army\Weapon\AbstractKnifeForge;
use Army\Weapon\Knife;

class KnifeForge extends AbstractKnifeForge
{
	public function createBarbarianKnife(): Knife
	{
		return new BarbarianKnife();
	}

	public function createRomeKnife(): Knife
	{
		return new RomeKnife();
	}
}