<?php

namespace Army\Weapon\Bows;
use Army\Weapon\Bow;

class RomeBow extends Bow
{
	public function damage(): int
	{
		return parent::damage()+2;
	}
}