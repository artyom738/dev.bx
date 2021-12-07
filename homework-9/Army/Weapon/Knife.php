<?php

namespace Army\Weapon;

class Knife implements Weapon
{

	public function damage(): int
	{
		return 25;
	}
}