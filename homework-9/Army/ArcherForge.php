<?php

namespace Army;

class ArcherForge extends Forge
{

	public function createWarrior(): Warrior
	{
		return new Archer();
	}
}