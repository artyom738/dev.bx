<?php

namespace Army\Weapon\Bows;
use Army\Weapon\AbstractBowForge;
use Army\Weapon\Bow;

class BowForge extends AbstractBowForge
{
	public function createBarbarianBow(): Bow
	{
		return new BarbarianBow();
	}

	public function createRomeBow(): Bow
	{
		return new RomeBow();
	}
}