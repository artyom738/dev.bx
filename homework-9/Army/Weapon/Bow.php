<?php

namespace Army\Weapon;

class Bow implements Weapon
{

	public function damage(): int
	{
		return 10;
	}
}