<?php

namespace Army\Weapon\Knifes;
use Army\Weapon\Knife;

class BarbarianKnife extends Knife
{
	public function damage(): int
	{
		return parent::damage()+3;
	}
}