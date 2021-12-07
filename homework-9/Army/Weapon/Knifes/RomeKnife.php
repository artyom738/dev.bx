<?php

namespace Army\Weapon\Knifes;
use Army\Weapon\Knife;

class RomeKnife extends Knife
{
	public function damage(): int
	{
		return parent::damage()+2;
	}
}