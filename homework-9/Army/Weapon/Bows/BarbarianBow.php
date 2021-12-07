<?php

namespace Army\Weapon\Bows;
use Army\Weapon\Bow;

class BarbarianBow extends Bow
{
	public function damage(): int
	{
		return parent::damage()-1;
	}
}