<?php

namespace External;

class FacebookAdResult
{
	public $targetingName;

	/**
	 * @return string
	 */
	public function getTargetingName(): string
	{
		return $this->targetingName;
	}

	/**
	 * @param string $targetingName
	 * @return FacebookAdResult
	 */
	public function setTargetingName(string $targetingName): FacebookAdResult
	{
		$this->targetingName = $targetingName;
		return $this;
	}
}