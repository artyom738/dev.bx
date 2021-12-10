<?php

namespace External;

class FacebookAdvertisement
{
	private $title;
	private $messageBody;

	/**
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
	}

	public function setTitle($title): FacebookAdvertisement
	{
		$this->title = $title;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getMessageBody(): string
	{
		return $this->messageBody;
	}

	public function setMessageBody($messageBody): FacebookAdvertisement
	{
		$this->messageBody = $messageBody;
		return $this;
	}

}